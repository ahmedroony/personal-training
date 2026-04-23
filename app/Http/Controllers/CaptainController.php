<?php

namespace App\Http\Controllers;

use App\interfaces\CaptainServiceInterface;
use App\Http\Requests\StoreCaptainRequest;
use App\Http\Requests\UpdateCaptainRequest;
use Illuminate\Http\Request;

class CaptainController extends Controller
{
    protected $captainService;

    public function __construct(CaptainServiceInterface $captainService)
    {
        $this->captainService = $captainService;
    }

    public function index()
    {
        $captains = $this->captainService->getAllCaptains();

        return view('captains.admin_panel.index', compact('captains'));
    }

    public function create()
    {
        return view('captains.admin_panel.create');
    }

    public function store(StoreCaptainRequest $request)
    {
        $validatedData = $request->validated();

        $this->captainService->storeCaptain($validatedData);

        return redirect()->route('admin.captains.index')
            ->with('success', 'تم إضافة الكابتن بنجاح!');
    }

    public function edit($id)
    {
        $captain = $this->captainService->getCaptainById($id);

        if (! $captain) {
            return redirect()->route('admin.captains.index')->with('error', 'الكابتن غير موجود.');
        }

        return view('captains.admin_panel.edit', compact('captain'));
    }

    public function update(UpdateCaptainRequest $request, $id)
    {
        $validatedData = $request->validated();

        $this->captainService->updateCaptain($id, $validatedData);

        return redirect()->route('admin.captains.index')
            ->with('success', 'تم تعديل بيانات الكابتن بنجاح!');
    }

    public function destroy($id)
    {
        $deleted = $this->captainService->deleteCaptain($id);

        if ($deleted) {
            return redirect()->route('admin.captains.index')->with('success', 'تم حذف الكابتن بنجاح!');
        }

        return redirect()->route('admin.captains.index')->with('error', 'حدث خطأ أثناء الحذف.');
    }
}
