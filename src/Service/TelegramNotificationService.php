<?php

namespace App\Service;

use App\Model\Order;
use Telegram\Bot\Api;

/**
 * Class TelegramNotificationService
 */
class TelegramNotificationService
{
    /**
     * @var Api
     */
    protected $client;

    /**
     * @var string
     */
    protected $chatId;

    /**
     * TelegramNotificationService constructor.
     *
     * @param string $apiKey
     *
     * @param string $chatId
     *
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    public function __construct(string $apiKey, string $chatId)
    {
        $this->client = new Api($apiKey);
        $this->chatId = $chatId;
    }

    public function sendMessage(Order $order)
    {
        $this->client->sendMessage(array(
            'chat_id' => $this->chatId,
            'text' => sprintf(
                "Новый заказ!\n\nКол-во кальянов: %d\nCмесь для кальяна кол-во: %d\nНомер телефона: %s\nАдрес: %s\nДата: %s\nВремя: %s",
                $order->count,
                $order->countAdditionalMixes,
                $order->phoneNumber,
                $order->address,
                $order->date,
                $order->time
            )
        ));
    }
}