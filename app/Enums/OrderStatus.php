<?php

namespace App\Enums;

enum OrderStatus: int
{
    case Pending = 1;       //esta en revision
    case Processing = 2;    //esta siendo alistado
    case Shipped = 3;       //el producto a sido enviado, en camino
    case Completed = 4;     //cuando el delivery llega al cliente 
    case Canceled = 5;      //cuando el cliente cancela el pedido
    case Failed = 6;        //El delivery llega a la casa del cliente y no está
    case Refunded = 7;      //El delivery llega con el producto cuando el cliente no está

}
