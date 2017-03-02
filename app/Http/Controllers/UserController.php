<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Model\User;
use App\Model\UserProfile;
use App\Model\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function api_profile($id)
    {
        $user_model = new User();
        $user_profile_model = new UserProfile();
        $user_role_model = new UserRole();
        $user_data = $user_model->find($id);
        $user_profile = $user_profile_model->find($id);
        $user_data['role_name'] = $user_role_model->find($user_data['role']);
        if (null !== $user_profile) {
            $user_data->profile = $user_profile;
        } else {
            $user_data->profile = new \stdClass();
        }
        if (count($user_data) > 0) {
            $this->response_json->status = true;
            $this->response_json->data = $user_data;
        }
        return $this->__json();
    }

    public function delete(Request $request)
    {
        if ($this->isPost() && null != Auth::user()) {
            $user_model = new User();
            $id = $request['id'];
            $where = array(
                ['id', '=', $id]
            );
            if ($user_model->find_v2($where)->delete()) {
                $this->response_json->status = true;
                $this->response_json->message = 'User deleted.';
            }
            return $this->__json();
        }
    }

    public function index(Request $request)
    {
        $user_role_model = new UserRole();
        if ($this->isPost()) {
            $columns = ['no', 'name', 'alias', 'email', 'avatar', 'action'];
            $user_model = new User();
            $where = array(
                ['name', 'LIKE', '%' . $request['search']['value'] . '%', 'OR'],
                ['email', 'LIKE', '%' . $request['search']['value'] . '%', 'OR'],
                ['alias', 'LIKE', '%' . $request['search']['value'] . '%', 'OR'],
            );
            $users = $user_model->find_v2($where, true, ['*'], intval($request['length']), intval($request['start']), $columns[intval($request['order'][0]['column'])], $request['order'][0]['dir']);

            $number = $request['start'] + 1;
            foreach ($users as &$item) {
                $item['no'] = $number;
                $item['is_permitted'] = ($user_role_model->find(Auth::user()->role)['profile'] == '1' || Auth::user()->id == $item['id']) ? true : false;
                $number++;
            }
            $response_json = array();
            $response_json['draw'] = $request['draw'];
            $response_json['data'] = $users;
            $response_json['recordsTotal'] = $user_model->getTableCount($where);
            $response_json['recordsFiltered'] = $user_model->getTableCount($where);
            return $this->__json($response_json);
        }

        if (null !== Auth::user()) {
            $styles = array();
            $styles[] = 'auth.css';

            $scripts = array();
            $scripts[] = 'user.js';

            $this->data['styles'] = $styles;
            $this->data['scripts'] = $scripts;
            $this->data['controller'] = 'users';
            $this->data['function'] = 'index';

            return view('user.index')->with('data', $this->data);
        }
        return Redirect::to('/dashboard');
    }

    public function login(Request $request)
    {
        if ($this->isPost()) {
            $rules = array(
                'email' => 'required|email',
                'password' => 'required'
            );

            if (null !== $this->validate_v2($request, $rules)) {
                $this->response_json->message = $this->validate_V2($request, $rules);
                return $this->__json();
            }

            $data = $request->all();

            if (Auth::attempt($data)) {
                $this->response_json->status = true;
            } else {
                $this->response_json->message = 'Email does not match with the password.';
            }
            return $this->__json();
        }
        if (null === Auth::user()) {
            $styles = array();
            $styles[] = 'style.css';
            $styles[] = 'auth.css';

            $scripts = array();
            $scripts[] = 'auth.js';

            $this->data['title'] = 'Login';
            $this->data['styles'] = $styles;
            $this->data['scripts'] = $scripts;

            return view('user.login')->with('data', $this->data);
        }
        return Redirect::to('/dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to('/user/login');
    }

    public function profile($id, Request $request)
    {
        $user_role_model = new UserRole();
        if ($this->isPost()) {
            if ($request['flag'] == 1) {
                $user_profile_model = new UserProfile();
                $where = array(
                    'id' => $request['id']
                );
                $record = array();
                foreach ($user_profile_model->getFillable() as $field) {
                    $record[$field] = $request[$field];
                }
                if ($user_profile_model->updateOrInsert_v2($where, $record)) {
                    $this->response_json->status = true;
                }
            } else {
                $rules = array(
                    'email' => 'required|email'
                );
                if (null !== $this->validate_v2($request, $rules)) {
                    $this->response_json->message = $this->validate_v2($request, $rules);
                    return $this->__json();
                }
                $user_model = new User();
                $where = array(
                    ['id', '<>', $id]
                );
                $select = array('email');
                $users_email = $user_model->find_v2($where, true, $select);

                foreach ($users_email as $item) {
                    if ($request['email'] == $item['email']) {
                        $this->response_json->message = 'Email already taken';
                        return $this->__json();
                    }
                }
                $where = array(
                    ['id', '=', $id]
                );

                $record = array();
                $record['name'] = $request['name'];
                $record['email'] = $request['email'];
                $record['alias'] = $request['alias'];
                if ($user_model->update_v2($where, $record)) {
                    $this->response_json->status = true;
                }
            }
            return $this->__json();
        }
        if (null !== Auth::user()) {
            $styles = array();

            $scripts = array();
            $scripts[] = 'user_profile.js';

            $this->data['styles'] = $styles;
            $this->data['scripts'] = $scripts;
            $this->data['function'] = 'index';
            $this->data['id'] = $id;
            $this->data['is_permitted'] = Auth::user()->id == $id || $user_role_model->find(Auth::user()->role)['profile'];
            $this->data['controller'] = 'users';
            return view('user.profile')->with('data', $this->data);
        }
        return Redirect::to('/user/login');
    }

    public function register(Request $request)
    {

        if ($this->isPost()) {
            $rules = array(
                'name' => 'required',
                'alias' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'repassword' => 'required|min:6|same:password',
            );

            if (null !== $this->validate_v2($request, $rules)) {
                $this->response_json->message = $this->validate_v2($request, $rules);
                return $this->__json();
            }

            if (null === $request['agree-terms']) {
                $this->response_json->message = 'Please agree our terms and condition.';
            } else {
                $user_model = new User();
                $data = array();
                foreach ($user_model->getFillable() as $field) {
                    if ($field == 'password') {
                        $data['password'] = Hash::make($request['password']);
                    } else if ($field == 'registered_by') {
                        $data['registered_by'] = Auth::user()->id;
                    } else {
                        $data[$field] = $request[$field];
                    }
                }
                User::create($data);
                $this->response_json->status = true;
            }
            return $this->__json();
        }
        if (null !== Auth::user()) {
            $styles = array();
            $styles[] = 'style.css';
            $styles[] = 'auth.css';

            $scripts = array();
            $scripts[] = 'auth.js';

            $this->data['title'] = 'Register';
            $this->data['controller'] = 'users';
            $this->data['function'] = 'index';
            $this->data['styles'] = $styles;
            $this->data['scripts'] = $scripts;

            return view('user.register')->with('data', $this->data);
        }
        return Redirect::to('/oops/permission');
    }

    public function update_image($id, Request $request)
    {
        if ($this->isPost()) {
            $rules = array(
                'photo' => 'mimes:jpg,JPG,jpeg,JPEG,png,PNG|max:2024'
            );
            $message = array(
                'mimes' => 'File must be a file of type jpg, jpeg or png'
            );
            if ($request->hasFile('photo')) {
                /* validate the request */
                if (null !== $this->validate_v2($request, $rules)) {
                    $this->response_json->message = $this->validate_V2($request, $rules, $message);
                    return $this->__json();
                }


                /* condition:
                 * has photo -> get the photo name -> unlink the photo -> named the new photo with the old name-> move
                 * has not photo -> named the photo with uniqid -> move
                 */
                $path = ASSETS_PATH . User::ASSETS;

                /* cek the photo in db */
                $user_model = new User();
                $user = $user_model->find($id);

                if (isset($user->photo)) {
                    $photo_name_old = $user->photo;
                    if (file_exists($path . $photo_name_old)) {
                        unlink($path . $photo_name_old);
                    }
                }
                $photo_name = uniqid('') . '.' . $request->photo->getClientOriginalExtension();
                $where = array(
                    ['id', '=', $id]
                );

                $update = array(
                    'photo' => $photo_name
                );
                $user->update_v2($where, $update);

                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
                $request->file('photo')->move($path, $photo_name);
                $this->response_json->data->photo = $photo_name;
                $this->response_json->status = true;

            } else {
                $this->response_json->message = 'File not found.';
            }


            $data = $request->all();
        }
        return $this->__json();
    }

    public function role_index(Request $request)
    {
        $user_role_model = new UserRole();
        $this->data['is_permitted'] = $user_role_model->find(Auth::user()->role)['role'] == '1' ? true : false;
        if ($this->isPost()) {
            $columns = ['no', 'name', 'description'];
            if ($this->data['is_permitted']) {
                $columns = ['check', 'no', 'name', 'description'];
            }
            $number = 1;
            $where = array(
                ['name', 'LIKE', '%' . $request['search']['value'] . '%', 'OR'],
                ['description', 'LIKE', '%' . $request['search']['value'] . '%', 'OR']
            );
            $user_roles = $user_role_model->find_v2($where, true, ['*'], intval($request['length']), intval($request['start']), $columns[intval($request['order'][0]['column'])], $request['order'][0]['dir']);
            foreach ($user_roles as &$item) {
                $item['no'] = $number;
                $number++;
            }
            $response_json = array();
            $response_json['draw'] = $request['draw'];
            $response_json['data'] = $user_roles;
            $response_json['recordsTotal'] = $user_role_model->getTableCount($where);
            $response_json['recordsFiltered'] = $user_role_model->getTableCount($where);
            return $this->__json($response_json);

        }

        if (null !== Auth::user()) {
            $styles = array();

            $scripts = array();
            $scripts[] = 'user_role.js';

            $this->data['styles'] = $styles;
            $this->data['scripts'] = $scripts;
            $this->data['controller'] = 'users';
            $this->data['function'] = 'role';

            return view('user.role-index')->with('data', $this->data);
        }
        return Redirect::to('/dashboard');
    }

    public function roleAdd(Request $request)
    {
        if ($this->isPost()) {
            $user_role_model = new UserRole();
            $rules = array(
                'name' => 'required'
            );

            if (null !== $this->validate_v2($request, $rules)) {
                $this->response_json->message = $this->validate_v2($request, $rules);
                return $this->__json();
            }
            $data = array();
            foreach ($user_role_model->getFillable() as $item) {
                if (isset($request[$item]))
                    $data[$item] = $request[$item];
            }
            UserRole::create($data);
            $this->response_json->status = true;
            return $this->__json();
        }
    }

    public function roleDelete(Request $request)
    {
        if ($this->isPost()) {
            $id = $request['id'];
            $user_role_model = new UserRole();
            if ($user_role_model->find($id)->delete()) {
                $this->response_json->status = true;
            }
            return $this->__json();
        }
    }

    public function roleUpdate(Request $request)
    {
        if ($this->isPost()) {
            $user_role_model = new UserRole();
            $data = array();
            $where = array(
                ['id', '=', $request['id']]
            );
            foreach ($user_role_model->getFillable() as $item) {
                $data[$item] = $request[$item];
            }
            if ($user_role_model->update_v2($where, $data)) {
                $this->response_json->status = true;
            }
            return $this->__json();

        }
    }

    public function roleMultipleDelete(Request $request)
    {
        if ($this->isPost()) {
            $user_role_model = new UserRole();
            $items = $request['items'];
            foreach ($items as $item) {
                $user_role_model->find($item)->delete();
            }
            $this->response_json->status = true;
            return $this->__json();
        }
    }
}
