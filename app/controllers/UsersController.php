<?php

class UsersController extends BaseController {

public function logout()
   {
  Auth::logout();

  return Redirect::route("accueil");
}

}
?>