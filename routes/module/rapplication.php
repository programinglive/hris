<?php

use App\Livewire\ApprovalPage;

Route::get('approvals', ApprovalPage::class)->name('approvals');
Route::get('printers', ApprovalPage::class)->name('printers');