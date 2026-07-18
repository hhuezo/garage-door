<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MailSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MailSettingsController extends Controller
{
    public function index(): View
    {
        return view('admin.mail.settings', [
            'settings' => MailSetting::current(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'max:255'],
            'from_address' => ['nullable', 'email', 'max:255'],
            'from_name' => ['nullable', 'string', 'max:255'],
            'admin_to' => ['nullable', 'email', 'max:255'],
        ]);

        $settings = MailSetting::current();

        $payload = [
            'username' => $validated['username'] ?? null,
            'from_address' => $validated['from_address'] ?? null,
            'from_name' => $validated['from_name'] ?? null,
            'admin_to' => $validated['admin_to'] ?? null,
        ];

        if (filled($validated['password'] ?? null)) {
            $payload['password'] = $validated['password'];
        }

        $settings->update($payload);

        return redirect()
            ->route('mail.settings')
            ->with('success', 'Mail settings saved.');
    }
}
