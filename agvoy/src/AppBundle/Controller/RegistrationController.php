<?php
namespace AppBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
class RegistrationController extends BaseController
{
	public function registerAction(Request $request)
	{
		$this->denyAccessUnlessGranted('ROLE_ADMIN'); //will work for admin as well
		$response = parent::registerAction($request);
		
		// ... do custom stuff
		return $response;
	}
}