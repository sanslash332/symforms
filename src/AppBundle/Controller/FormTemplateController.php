<?php

namespace AppBundle\Controller;

use AppBundle\Entity\FormTemplate;
use AppBundle\Entity\Question;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Formtemplate controller.
 *
 * @Route("formtemplate")
 */
class FormTemplateController extends Controller
{
    /**
     * Lists all formTemplate entities.
     *
     * @Route("/", name="formtemplate_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $formTemplates = $em->getRepository('AppBundle:FormTemplate')->findAll();

        return $this->render('formtemplate/index.html.twig', array(
            'formTemplates' => $formTemplates,
        ));
    }

    /**
     * Creates a new formTemplate entity.
     *
     * @Route("/new", name="formtemplate_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $formTemplate = new Formtemplate();
        $form = $this->createForm('AppBundle\Form\FormTemplateType', $formTemplate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($formTemplate);
            $em->flush();

            return $this->redirectToRoute('formtemplate_show', array('id' => $formTemplate->getId()));
        }

        return $this->render('formtemplate/new.html.twig', array(
            'formTemplate' => $formTemplate,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a formTemplate entity.
     *
     * @Route("/{id}", name="formtemplate_show")
     * @Method("GET")
     */
    public function showAction(FormTemplate $formTemplate)
    {
        $deleteForm = $this->createDeleteForm($formTemplate);
$q = new Question();
$q->setForm($formTemplate);
$questionForm = $this->createForm('AppBundle\Form\QuestionType',$q, array(
'action' => $this->generateUrl('question_new')
));
$questionForm->get('form')->setData($formTemplate->getId());



        return $this->render('formtemplate/show.html.twig', array(
            'formTemplate' => $formTemplate,
            'delete_form' => $deleteForm->createView(),
'questionForm' => $questionForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing formTemplate entity.
     *
     * @Route("/{id}/edit", name="formtemplate_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, FormTemplate $formTemplate)
    {
        $deleteForm = $this->createDeleteForm($formTemplate);
        $editForm = $this->createForm('AppBundle\Form\FormTemplateType', $formTemplate);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('formtemplate_edit', array('id' => $formTemplate->getId()));
        }

        return $this->render('formtemplate/edit.html.twig', array(
            'formTemplate' => $formTemplate,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a formTemplate entity.
     *
     * @Route("/{id}", name="formtemplate_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, FormTemplate $formTemplate)
    {
        $form = $this->createDeleteForm($formTemplate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($formTemplate);
            $em->flush();
        }

        return $this->redirectToRoute('formtemplate_index');
    }

    /**
     * Creates a form to delete a formTemplate entity.
     *
     * @param FormTemplate $formTemplate The formTemplate entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(FormTemplate $formTemplate)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('formtemplate_delete', array('id' => $formTemplate->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
