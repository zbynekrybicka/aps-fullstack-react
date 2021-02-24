<?php
namespace App;


use App\Relations\FullStack;
use App\Relations\Component;

class Process
{
    private $fullStack;

    /**
     * Component constructor.
     * @param FullStack $fullStack
     */
    public function __construct(FullStack $fullStack) {
        $this->fullStack = $fullStack;
    }


    /**
     *
     *
     *
     */
    public function App() {
        $component = $this->fullStack->component('App');
        $component->subComponent('LoginForm')
            ->condition('!AuthToken', 'AuthToken', 'authToken', null);
        $component->subComponent('Admin')
            ->condition('AuthToken');
    }


    /**
     *
     *
     *
     *
     */
    public function LoginForm() {
        $component = $this->fullStack->component('LoginForm');

        $this->inputText($component, 'username', 'loginForm.username', 'Přihlašovací jméno');
        $this->inputPassword($component, 'password', 'loginForm.password', 'Heslo');

        $component->content('button')
            ->attribute('className', 'blue')
            ->content('Přihlásit se')
            ->eventAction('click', 'postLogin')
            ->request('post', '/login', 'loginForm', 'userAuth', false)
            ->success([ 'state.authToken = action.payload.authToken' ])
            ->error([ "state.errorMessage = 'Přihlášení nebylo úspěšné. Zkontrolujte přihlašovací údaje.'" ])
            ->service()
            ->resource('userAuth', 'UserAuthResource')
            ->method([ 'return $this->userAuth->login($request); ']);
    }


    /**
     *
     *
     *
     *
     */
    public function Admin()
    {
        $this->fullStack->component('Admin')
            ->content('div');
    }


    /**
     *
     * @param Component $component
     * @param string $variable
     * @param string $store
     * @param string $placeholder
     */
    private function inputText(Component $component, $variable, $store, $placeholder = '')
    {
        $component->content('input')
            ->attribute('type', 'text')
            ->attribute('placeholder', $placeholder)
            ->vModel($variable, $store);

    }


    /**
     *
     * @param Component $component
     * @param string $variable
     * @param string $store
     * @param string $placeholder
     */
    private function inputPassword(Component $component, $variable, $store, $placeholder = '')
    {
        $component->content('input')
            ->attribute('type', 'password')
            ->attribute('placeholder', $placeholder)
            ->vModel($variable, $store);
    }

}