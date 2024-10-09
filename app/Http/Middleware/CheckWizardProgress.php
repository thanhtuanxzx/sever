<?php

// app/Http/Middleware/CheckWizardProgress.php
// app/Http/Middleware/CheckWizardProgress.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WizardProgress;

class CheckWizardProgress
{
        public function handle(Request $request, Closure $next, $step)
    {
        $userId = Auth::id();
        $progress = WizardProgress::where('user_id', $userId)->orderBy('created_at', 'desc')->first();

        if (!$progress) {
            // Nếu không có tiến trình và không phải bước đầu tiên, chuyển hướng về bước đầu tiên
            if ($step != 1) {
                return redirect()->route('wizard.step1')->withErrors(['error' => 'Bạn cần bắt đầu từ bước 1.']);
            }
        } else {
            // Nếu tiến trình hiện tại thấp hơn bước trước đó, chuyển hướng đến bước tiếp theo
            if ($progress->current_step < $step - 1) {
                return redirect()->route('wizard.step' . ($progress->current_step + 1))->withErrors(['error' => 'Bạn cần hoàn thành bước trước đó.']);
            }
            // Nếu tiến trình hiện tại lớn hơn bước hiện tại, chuyển hướng về bước hiện tại
            elseif ($progress->current_step > $step) {
                return redirect()->route('wizard.step' . $progress->current_step)->withErrors(['error' => 'Bạn không thể quay lại bước trước đó.']);
            }
        }

        return $next($request);
    }

}