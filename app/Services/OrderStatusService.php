<?php

namespace App\Services;

use Exception;
use App\Models\OrderStatus;

class OrderStatusService
{
    static function getAllOrderStatuses()
    {
        return OrderStatus::all();
    }
    static function storeOrderStatus($data)
    {
        $order_status = OrderStatus::create($data);
        if (!$order_status) {
            return 'Order status creation failed, something must have gone wrong';
        }
        if ($data['can_transit_into'] ?? null) {
            foreach ($data['can_transit_into'] as $id) {
                $order_status->statuses()->attach($id);
            }
        }
        return 'Order status created successfully';
    }
    static function findOrderStatus($id)
    {
        $order_status = OrderStatus::find($id);
        if (!$order_status) {
            abort(404);
        }
        return $order_status;
    }
    static function updateOrderStatus($id, $data)
    {
        try {
            $order_status = static::findOrderStatus($id);
            $order_status->update($data);
            foreach (OrderStatus::all() as $other_order_status) {
                $order_status->statuses->contains($other_order_status->id) ? $order_status->statuses()->detach($other_order_status->id) : '';
            }
            if ($data['can_transit_into'] ?? null) {
                foreach ($data['can_transit_into'] as $id) {
                    $order_status->statuses()->attach($id);
                }
            }
            return 'Order status updated successfully';
        } catch (Exception $e) {
            return 'Something went wrong, Exception message: ' . $e->getMessage();
        }
    }
    static function getAllFSS()
    {
        return OrderStatus::all()->where('first_step_status', 1);
    }
}
