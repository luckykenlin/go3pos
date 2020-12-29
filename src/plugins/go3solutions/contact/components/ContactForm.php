<?php namespace Go3solutions\Contact\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use October\Rain\Exception\ValidationException;
use October\Rain\Support\Facades\Flash;

class ContactForm extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Contact Form',
            'description' => 'Simple Contact Form'
        ];
    }

    public function onSend()
    {
        $vars = [
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'subject' => Input::get('subject'),
            'content' => Input::get('message')
        ];
        Flash::success('Thank you for contact us.');
        Mail::queue('go3solutions.contact::mail.message', $vars, function ($message) use ($vars) {
            $message->to(env('SUPPORT_EMAIL', 'luckykenlin@gmail.com'), 'Ezupos');
            $message->subject($vars['subject']);
        });
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
                'phone' => 'required|max:50',
                'message' => 'required|max:5000',
            ]
        );

        if ($validator->passes()) {
            $vars = [
                'name' => Input::get('name'),
                'email' => Input::get('email'),
                'phone' => Input::get('phone'),
                'content' => Input::get('message'),
            ];
            Flash::success('Apply successfully.');
            Mail::queue('go3solutions.contact::mail.message', $vars, function ($message) use ($vars) {
                $message->to(env('SUPPORT_EMAIL', 'luckykenlin@gmail.com'), 'Ezupos');
                $message->subject('New Case of ' . $vars['name']);
            });
        } else {
            throw new ValidationException($validator);
        }
    }
}