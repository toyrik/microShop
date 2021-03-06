<?php


namespace App\Controller;

use App\Entity\Item;
use App\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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

        return $this->render('home/index.html.twig',[
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/", name="posHome" , methods={"post"})
     * @param Request $request
     * @return Response
     */
    public function list(Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $form = $this->getFilterForm();
        $form->handleRequest($request);

        $params = $request->get('form');
        $itemRepository = $entityManager->getRepository(Item::class);
        $items = $itemRepository->findByFilter($params);
        if(!empty($items)) {
            $rows = [];
            foreach ($items as $item){
                $data = array(
                    $item->getId(),
                    $item->getName(),
                );
                $rows[] = implode(',', $data);
               $item->setShowCount($item->getShowCount()+1);
               $entityManager->persist($item);
               $entityManager->flush();
            }

            $content = implode("\n", $rows);
            $response = new Response($content);
            $response->headers->set('Content-Type', 'text/csv');

            return $response;
        }

        return $this->render('home/index.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    protected function getFilterForm()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $tagsRepository = $entityManager->getRepository(Tag::class);
        $tags = $tagsRepository->findAll();
        $options = [];
        foreach ($tags as $tag){
            $options[$tag->getName()] = $tag->getId();
        }

        return $this->createFormBuilder()
            ->add('with', ChoiceType::class, array(
                'multiple' => true,
                'attr' => ['class' => 'form-select filter'],
                'label' => '????????????????',
                'required' => false,
                'label_attr' => ['class' => 'label'],
                'choices' => $options,
            ))
            ->add('without', ChoiceType::class, array(
                'multiple' => true,
                'attr' => ['class' => 'form-select filter'],
                'label' => '??????????????????',
                'required' => false,
                'label_attr' => ['class' => 'label'],
                'choices' => $options,
            ))
            ->add('Filter', SubmitType::class, array(
                'attr' => ['class' => 'btn btn-primary']
            ))
            ->getForm();
    }
}
