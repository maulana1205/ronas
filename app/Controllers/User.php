<?php

namespace App\Controllers;

use App\Models\UserModel;

class User extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->session = session();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // Fetch users with pagination
        $users = $this->userModel->paginate(10);
        
        // Replace created_by value of 0 with 'admin'
        foreach ($users as $user) {
            if ($user->created_by == 0) {
                $user->created_by = 'admin';
            }
        }

        return view('user/index', [
            'users' => $users,
            'pager' => $this->userModel->pager,
        ]);
    }

    public function edit($id)
    {
        // Fetch the user by ID
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        return view('user/edit', [
            'user' => $user,
            'validation' => $this->validation,
        ]);
    }

    public function update($id)
    {
        // Set validation rules
        $this->validation->setRules([
            'username' => 'required|min_length[3]|max_length[255]',
            'password' => 'permit_empty|min_length[8]',
            'password_confirm' => 'matches[password]',
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('validation', $this->validation);
        }

        // Prepare data for update
        $data = [
            'username' => $this->request->getPost('username'),
            'updated_by' => 'admin',
            'updated_date' => date('Y-m-d H:i:s'),
        ];

        // If password is provided, hash it and add it to the data
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Update the user record
        $this->userModel->update($id, $data);

        return redirect()->to('/user')->with('success', 'User updated successfully');
    }

    public function delete($id)
    {
        // Check if the user exists
        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        // Delete the user
        $this->userModel->delete($id);

        return redirect()->to('/user')->with('success', 'User deleted successfully');
    }

    public function export()
    {
        // Fetch all users
        $users = $this->userModel->findAll();

        // Set headers for CSV download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="users.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');

        // Write CSV headers
        fputcsv($output, ['ID', 'Username', 'Created By', 'Created Date']);

        // Write user data to CSV
        foreach ($users as $user) {
            $user->created_by = ($user->created_by == 0) ? 'admin' : $user->created_by;
            fputcsv($output, [
                $user->id,
                $user->username,
                $user->created_by,
                $user->created_date,
            ]);
        }

        fclose($output);
        exit;
    }
}
