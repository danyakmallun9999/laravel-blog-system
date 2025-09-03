<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $contactInfo = [
            'email' => 'danyclasher9999@gmail.com',
            'phone' => '+62 812 3456 7890',
            'socials' => [
                ['name' => 'GitHub', 'url' => 'https://github.com/danyakmallun9999', 'icon' => 'fab fa-github'],
                ['name' => 'LinkedIn', 'url' => 'https://www.linkedin.com/in/dany-akmallun-ni-am-786580230/', 'icon' => 'fab fa-linkedin'],
                ['name' => 'Twitter', 'url' => 'https://twitter.com/danyakmallun', 'icon' => 'fab fa-twitter'],
            ],
        ];

        return view('contact.index', compact('contactInfo'));
    }

    // Jika ada form kontak:
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'message' => 'required|string|min:10',
    //     ]);

    //     // Logika mengirim email atau menyimpan ke database
    //     // Mail::to('admin@example.com')->send(new ContactFormMail($validated));

    //     return redirect()->route('contact.index')->with('success', 'Pesanmu telah terkirim!');
    // }
}
