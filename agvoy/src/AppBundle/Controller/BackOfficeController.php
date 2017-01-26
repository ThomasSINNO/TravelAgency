<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Circuit;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Entity\ProgrammationCircuit;
use AppBundle\Entity\Etape;
/**
 * Back_office controller.
 */
class BackOfficeController extends Controller
{
	/**
	 * Lists all Circuit entities with modifying and deleting options
	 *
	 * @Route("/back_office/", name="back_office_index")
	 * @Method("GET")
	 */
	public function indexAction()
	{
		$this->denyAccessUnlessGranted('ROLE_USER');
		$em = $this->getDoctrine()->getManager();

		$circuits = $em->getRepository('AppBundle:Circuit')->findAll();

		return $this->render('back_office/index.html.twig', array(
				'circuits' => $circuits,
		));
	}

	/**
	 * Finds and displays a Circuit entity.
	 *
	 * @Route("/back_office/{id}", name="back_show", requirements={
	 *              "id": "\d+"
	 *     })
	 * @Method("GET")
	 */
	public function showAction(Circuit $circuit)
	{
		
		return $this->render('back_office/show.html.twig', array(
            'circuit' => $circuit,
        ));
		/** function progForm(ProgrammationCircuit $prog){
			$form2=$this->createFormBuilder($prog)
				->add('dateDepart', DateType::class)
				->add('nombrePersonnes', IntegerType::class)
				->add('prix', IntegerType::class)
				->getForm();
			
			return($form2);
		}
		**/
		
		
		
	}
	
	
	/**
	 * Modify a Circuit
	 * 
	 * @Route("/back_office/modify_circuit/{id}", name="back_modify_circuit", requirements={"id":"\d+"})
	 * 
	 */
	public function modifyCircuitAction(Circuit $circuit){
		
		$form=$this->createFormBuilder($circuit)
		->add('description', TextType::class)
		->add('paysDepart', TextType::class)
		->add('villeDepart', TextType::class)
		->add('villeArrivee', TextType::class)
		->add('dureeCircuit', IntegerType::class)
		->getForm();
		
		return $this->render('back_office/modify.html.twig', array(
				'form' => $form->createView(),
		));
	}
	
	/**
	 * Modify a Programmation
	 * 
	 * @Route("/back_office/modify_prog/{id}", name="back_modify_prog", requirements={"id":"\d+"})
	 */
	
	public function modifyProgAction(ProgrammationCircuit $prog){
		
		$form=$this->createFormBuilder($prog)
		->add('dateDepart', DateType::class)
		->add('nombrePersonnes', IntegerType::class)
		->add('prix', IntegerType::class)
		->add('enregistrer',SubmitType::class,array('label' => 'enregistrer'))
		->getForm();
		
		if ($form->isSubmitted() && $form->isValid()){
			$info=$form->getData();
			$prog=$info;
			/**$em=$this->getDoctrine()->getManager();
			*$em->persist($info);
			*$em->flush()
			*/
			return $this->redirectToRoute('back_office_index');
		}
		
		return $this->render('back_office/modify.html.twig', array(
				'form'=> $form->createView(),
				
		));
		
	}
	
	/**
	 * Modifier une etape
	 * 
	 * @Route("/back_office/modify_etape/{id}", name="back_modify_etape", requirements={"id":"\d+"})
	 */
	
	public function modifyEtapeAction(Etape $etape){
		
		$form=$this->createFormBuilder($etape)
		->add('numeroEtape', IntegerType::class)
		->add('villeEtape', TextType::class)
		->add('nombreJours', IntegerType::class)
		->getForm();
		
		return $this->render('back_office/modify.html.twig', array(
				'form'=> $form->createView(),
		
				));
	}
}
