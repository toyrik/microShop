<?php


namespace App\Controller;

use App\Entity\Item;
use App\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home" , methods={"get"})
     * @return Response
     */
    public function index(): Response
    {
        $form = $this->getFilterForm();

        $number = random_int(0,100);
        return $this->render('home/index.html.twig',[
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/", name="posHome" , methods={"post"})
     * @return Response
     */
    public function list(Request $request): Response
    {
        $form = $this->getFilterForm();
        $number = ($request->request->get('number')) ? $request->request->get('number') : random_int(0,100);

        return $this->render('home/index.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    protected function getFilterForm()
    {
        return $this->createFormBuilder()
            ->add('with', ChoiceType::class, array(
                'multiple' => true,
                'attr' => ['class' => 'form-select filter'],
                'label' => 'Включить',
                'required' => false,
                'label_attr' => ['class' => 'label'],
                'choices' => array(
                    'Одежда' => 1,
                    'Обувь' => 2,
                    'Стиль' => 3,
                    'Повседневное' => 4,
                    'Черное' => 5,
                    'Белое' => 6,
                ),
            ))
            ->add('without', ChoiceType::class, array(
                'multiple' => true,
                'attr' => ['class' => 'form-select filter'],
                'label' => 'Исключить',
                'required' => false,
                'label_attr' => ['class' => 'label'],
                'choices' => array(
                    'Одежда' => 1,
                    'Обувь' => 2,
                    'Стиль' => 3,
                    'Повседневное' => 4,
                    'Черное' => 5,
                    'Белое' => 6,
                ),
            ))
            ->add('Filter', SubmitType::class, array(
                'attr' => ['class' => 'btn btn-primary']
            ))
            ->getForm();
    }
}
