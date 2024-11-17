<?php namespace App\Controllers;

use App\Models\UserModel;

class Profile extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $userId = session()->get('id'); // Assuming the user ID is stored in session
        $user = $userModel->find($userId);
        
        return view('profile/index', [
            'user' => $user,
        ]);
    }

    public function edit()
    {
        $userModel = new UserModel();
        $userId = session()->get('id');
        
        // If the form is submitted
        if ($this->request->getPost()) {
            $data = $this->request->getPost();
            // Handle the profile update logic here
            $userModel->update($userId, $data);
            return redirect()->to(site_url('profile'))->with('success', 'Profile updated successfully!');
        }

        $user = $userModel->find($userId);
        return view('profile/edit', [
            'user' => $user,
        ]);
    }
}
