<?php
  namespace App\Controller;

  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\HttpFoundation\Request;
  use Symfony\Component\Routing\Annotation\Route;
  use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

  use Symfony\Bundle\FrameworkBundle\Controller\Controller;

  use App\Entity\Student;

  use Symfony\Component\Form\Extension\Core\Type\TextType;
  use Symfony\Component\Form\Extension\Core\Type\TextareaType;
  use Symfony\Component\Form\Extension\Core\Type\SubmitType;


  class StudentController extends Controller {

    /**
     * @Route("/list", name="studentList")
     * @Method({"GET"})
     */
    public function list() {

        $students= $this->getDoctrine()->getRepository
        (Student::class)->findAll();
      
        return $this->render('students/list.html.twig', array('students' => $students));
      }



           /**
     * @Route("/student/novy", name="studentNew")
     * @Method({"GET", "POST"})
     */
    public function new(Request $request) {
        $student = new Student();
  
        $form = $this->createFormBuilder($student)
          ->add('jmeno', TextType::class, array('attr' => array('class' => 'form-control')))
          ->add('znamka', TextareaType::class, array(
            /* # 'required' => false,*/
            'attr' => array('class' => 'form-control')
          ))
          ->add('save', SubmitType::class, array(
            'label' => 'Vytvořit',
            'attr' => array('class' => 'btn btn-primary mt-3')
          ))
          ->getForm();
  
        $form->handleRequest($request);
  
        if($form->isSubmitted() && $form -> isValid()) {
          $student = $form->getData();
  
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($student);
          $entityManager->flush();
  
          return $this->redirectToRoute('studentList');
        }
  
        return $this->render('students/new.html.twig', array(
          'form' => $form->createView()
        ));
      }

       /**
     * @Route("/student/edit/{id}", name="studentEdit")
     * @Method({"GET", "POST"})
     */
    public function edit(Request $request, $id) {
      $student = new Student();
      $student = $this->getDoctrine() 
        ->getRepository(Student::class) 
        ->find($id);

      $form = $this->createFormBuilder($student)
        ->add('jmeno', TextType::class, array('attr' => array('class' => 'form-control')))
        ->add('znamka', TextareaType::class, array(
          /* # 'required' => false,*/
          'attr' => array('class' => 'form-control')
        ))
        ->add('save', SubmitType::class, array(
          'label' => 'Upravit',
          'attr' => array('class' => 'btn btn-primary mt-3')
        ))
        ->getForm();

      $form->handleRequest($request);

      if($form->isSubmitted() && $form -> isValid()) {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        return $this->redirectToRoute('studentList');
      }

      return $this->render('students/edit.html.twig', array(
        'form' => $form->createView()
      ));
    }

      /**
     * @Route("/students/delete/{id}", name="studentDelete")
     * @Method({"DELETE"})
     */
    public function delete(Request $request, $id) {
      $student = $this->getDoctrine()->getRepository(Student::class)->find($id);

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->remove($student);
      $entityManager->flush();

      $response = new Response();
      $response->send();
    }


    /**
     * @Route("/student/{id}", name="studentShow")
    */
    public function show($id) {
        $student = $this->getDoctrine() 
          ->getRepository(Student::class) 
          ->find($id);
  
        return $this->render('students/show.html.twig', array('student' => $student));
      }
}