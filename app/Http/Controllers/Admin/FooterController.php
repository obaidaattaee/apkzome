<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOSVersionRequest;
use App\Models\Footer;
use App\Models\OSVersion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class OSVersionController
 * @package App\Http\Controllers\Admin
 */
class FooterController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $footers = Footer::with(['parent'])->get();
        return view('admin.footer.index')->with('footers', $footers);
    }

    /**
     * show create OS Version page
     * @return View
     */
    public function create(): View
    {
        $footers = Footer::doesnthave('parent')->get();
        return view('admin.footer.create')->with('footers', $footers);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        Footer::create($request->all());
        return redirect()->route('footers.index')->with('message', __('common.created_successfully'));
    }


    /**
     * @param Footer $footer
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Footer $footer): RedirectResponse
    {
        $footer->delete();
        return redirect()->route('footers.index')->with('message', __('common.delete_successfully'));
    }

    /**
     * @param OSVersion $version
     * @return View
     */
    public function edit(Footer $footer): View
    {
        $footers = Footer::doesnthave('parent')->get();
        return view('admin.footer.edit')->with('footer', $footer)->with('footers', $footers);
    }

    /**
     * @param StoreOSVersionRequest $request
     * @param OSVersion $version
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Footer $footer)
    {
        $footer->update($request->all());
        return redirect()->route('footers.index')->with('message', __('common.update_successfully'));
    }
}
