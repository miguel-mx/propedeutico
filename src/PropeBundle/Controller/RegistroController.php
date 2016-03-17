<?php

namespace PropeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use PropeBundle\Entity\Registro;
use PropeBundle\Form\RegistroType;

/**
 * Registro controller.
 *
 * @Route("/registro")
 */
class RegistroController extends Controller
{
    /**
     * Lists all Registro entities.
     *
     * @Route("/", name="registro_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        // Access control
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Acceso restringido');

        $em = $this->getDoctrine()->getManager();

        $registros = $em->getRepository('PropeBundle:Registro')->findAll();

        return $this->render('registro/index.html.twig', array(
            'registros' => $registros,
        ));
    }

    /**
     * Creates a new Registro entity.
     *
     * @Route("/new", name="registro_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $registro = new Registro();
        $form = $this->createForm('PropeBundle\Form\RegistroType', $registro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($registro);
            $em->flush();

            $message = \Swift_Message::newInstance()
                ->setSubject('Confirmación Solicitud Beca - Propedéutico PCCM')
                ->setFrom('webmaster@matmor.unam.mx')
                ->setTo($registro->getCorreo())
                ->setBcc('miguel@matmor.unam.mx')
                ->setBody(
                    $this->renderView('registro/email.txt.twig', array('registro' => $registro)
                    )
                )
            ;

            $this->get('mailer')->send($message);

            $request->getSession()
                ->getFlashBag()
                ->add('success', 'El registro se ha llevado a cabo con éxito!')
            ;

            return $this->render('registro/confirm.html.twig', array('registro' => $registro));
        }

        return $this->render('registro/new.html.twig', array(
            'registro' => $registro,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Registro entity.
     *
     * @Route("/{slug}", name="registro_show")
     * @Method("GET")
     */
    public function showAction(Registro $registro)
    {
        // Access control
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Acceso restringido');

        $deleteForm = $this->createDeleteForm($registro);

        $evalform = $this->createFormBuilder($registro)
            ->setAction($this->generateUrl('registro_eval'))
            ->setMethod('POST')
            ->add('concedido', 'Symfony\Component\Form\Extension\Core\Type\CheckboxType', array(
                'label' => 'Otorgar Beca', 'required' => false
            ))
            ->add('notas', 'Symfony\Component\Form\Extension\Core\Type\TextareaType', array(
                'label' => 'Notas', 'required' => false
            ))
            ->getForm();

        return $this->render('registro/show.html.twig', array(
            'registro' => $registro,
            'delete_form' => $deleteForm->createView(),
            'eval_form' => $evalform->createView(),
        ));
    }

    /**
     * Evaluate a Registro entity.
     *
     * @Route("/eval", name="registro_eval")
     * @Method({"POST"})
     */
    public function evalAction(Request $request)
    {
        $registro = new Registro();

        $evalform = $this->createFormBuilder($registro)
            ->setAction($this->generateUrl('registro_eval'))
            ->setMethod('POST')
            ->add('concedido', 'Symfony\Component\Form\Extension\Core\Type\CheckboxType', array(
                'label' => 'Otorgar Beca', 'required' => false
            ))
            ->add('notas', 'Symfony\Component\Form\Extension\Core\Type\TextareaType', array(
                'label' => 'Notas', 'required' => false
            ))
            ->getForm();

        $evalform->handleRequest($request);

        if ($evalform->isSubmitted() && $evalform->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($registro);
            $em->flush();

            $request->getSession()
                ->getFlashBag()
                ->add('success', 'Registro modificado')
            ;
        }

        return $this->redirect($this->generateUrl('registro_show', array('slug' => 'miguel-angel-magana-lemus-28')));
//        {{ path('registro_show', { 'slug': registro.slug }) }}
    }


    /**
     * Displays a form to edit an existing Registro entity.
     *
     * @Route("/{slug}/edit", name="registro_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Registro $registro)
    {
        // Access control
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Acceso restringido');

        $deleteForm = $this->createDeleteForm($registro);
        $editForm = $this->createForm('PropeBundle\Form\RegistroType', $registro);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($registro);
            $em->flush();

            return $this->redirectToRoute('registro_edit', array('id' => $registro->getId()));
        }

        return $this->render('registro/edit.html.twig', array(
            'registro' => $registro,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Registro entity.
     *
     * @Route("/{id}", name="registro_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Registro $registro)
    {
        $form = $this->createDeleteForm($registro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($registro);
            $em->flush();
        }

        return $this->redirectToRoute('registro_index');
    }

    /**
     * Creates a form to delete a Registro entity.
     *
     * @param Registro $registro The Registro entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Registro $registro)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('registro_delete', array('id' => $registro->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    private function sendEmail(Registro $registro)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Confirmación Solicitud Beca - Propedéutico PCCM')
            ->setFrom('webmaster@matmor.unam.mx')
            ->setTo($registro->getCorreo())
            ->setBody(
                $this->render('registro/email.txt.twig',
                    array('registro' => $registro)
                )
            )
        ;
    }
}
