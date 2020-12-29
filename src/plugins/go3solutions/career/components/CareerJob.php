<?php namespace Go3solutions\Career\Components;

use Cms\Classes\ComponentBase;
use Go3solutions\Career\Models\CareerJob as CareerJobModal;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use October\Rain\Exception\ValidationException;
use October\Rain\Support\Facades\Flash;

class CareerJob extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Career Job',
            'description' => 'Simple Job Form'
        ];
    }

    public function jobs()
    {
        return CareerJobModal::all();
    }

    /**
     * @throws ValidationException
     */
    public function onSubmit()
    {
        $validator = Validator::make(Input::all(),
            [
                'name' => 'required|max:50',
                'email' => 'required|max:50',
                'job_title' => 'required|max:50',
                'message' => 'required|max:1000',
                'resume' => 'required|mimes:doc,docx,pdf|max:500000',
            ]
        );

        if ($validator->passes()) {
            $path = Storage::disk('s3')->putFile('icon-payments/uploads', Input::file('resume'));
            $vars = [
                'name' => Input::get('name'),
                'email' => Input::get('email'),
                'jobTitle' => Input::get('job_title'),
                'content' => Input::get('message'),
            ];
            Flash::success('Apply successfully.');
            Mail::queue('go3solutions.career::mail.message', $vars, function ($message) use ($vars, $path) {
                $message->to(env('SUPPORT_EMAIL', 'luckykenlin@gmail.com'), 'Ezupos');
                $message->subject($vars['jobTitle']);
                $message->attach(Storage::disk('s3')->url($path));
            });
        } else {
            throw new ValidationException($validator);
        }
    }
}
