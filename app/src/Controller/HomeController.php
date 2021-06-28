<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home" , methods={"get"})
     * @return Response
     */
    public function index(): Response
    {
        $number = random_int(0,100);
        return $this->render('home/index.html.twig',[
            'number' => $number,
        ]);
    }

    /**
     * @Route("/", name="posHome" , methods={"post"})
     * @return Response
     */
    public function list(Request $request): Response
    {
        $number = ($request->request->get('number')) ? $request->request->get('number') : random_int(0,100);

        return $this->render('home/index.html.twig',[
            'number' => $number,
        ]);
    }
}
