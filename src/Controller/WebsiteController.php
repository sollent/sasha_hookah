<?php

namespace App\Controller;

use App\Form\OrderForm;
use App\Model\Order;
use App\Service\TelegramNotificationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class WebsiteController extends AbstractController
{
    private TelegramNotificationService $telegramNotificationService;

    /**
     * @param TelegramNotificationService $telegramNotificationService
     */
    public function __construct(TelegramNotificationService $telegramNotificationService)
    {
        $this->telegramNotificationService = $telegramNotificationService;
    }

    /**
     * @Route(
     *     "/",
     *     name="home-action"
     * )
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route(
     *     "/create-order",
     *     name="create-order-action",
     *     methods={"POST"}
     * )
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createOrder(Request $request): Response
    {
        $order = new Order();
        $order->count = (int)$request->request->get('count');
        $order->insiderCity = (bool)$request->request->get('insiderCity');
        $order->countAdditionalMixes = (int)$request->request->get('countAdditionalMixes');
        $order->phoneNumber = $request->request->get('phoneNumber');
        $order->address = $request->request->get('address');
        $order->date = $request->request->get('date');
        $order->time = $request->request->get('time');

        $this->telegramNotificationService->sendMessage($order);

        return $this->redirectToRoute('home-action');
    }

    private function getErrorMessages(\Symfony\Component\Form\Form $form) {
        $errors = array();

        foreach ($form->getErrors() as $key => $error) {
            if ($form->isRoot()) {
                $errors['#'][] = $error->getMessage();
            } else {
                $errors[] = $error->getMessage();
            }
        }

        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = $this->getErrorMessages($child);
            }
        }

        return $errors;
    }
}