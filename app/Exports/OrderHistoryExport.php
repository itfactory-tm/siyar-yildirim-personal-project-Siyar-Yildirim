<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class OrderHistoryExport
{
    protected $orders;

    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    public function collection()
    {
        $rows = collect();

        foreach ($this->orders as $order) {
            foreach ($order->orderlines as $orderline) {
                $rows->push([
                    'order' => $order,
                    'orderline' => $orderline
                ]);
            }
        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            'Order Date',
            'Order ID',
            'Product Name',
            'Quantity',
            'Unit Price',
            'Line Total',
            'Order Total',
            'Status'
        ];
    }

    public function map($row): array
    {
        $order = $row['order'];
        $orderline = $row['orderline'];

        return [
            $order->created_at->format('M d, Y H:i'),
            $order->id,
            $orderline->product_name,
            $orderline->quantity,
            '$' . number_format($orderline->line_total / $orderline->quantity, 2),
            '$' . number_format($orderline->line_total, 2),
            '$' . number_format($order->total_price, 2),
            ucfirst($order->status ?? 'Completed')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Header row styling
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                    'size' => 12
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '3B82F6']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ]
            ],
            // All data styling
            'A:H' => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'E5E7EB']
                    ]
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER
                ]
            ],
            // Currency columns alignment
            'E:G' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_RIGHT
                ]
            ]
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 18, // Order Date
            'B' => 12, // Order ID
            'C' => 30, // Product Name
            'D' => 10, // Quantity
            'E' => 12, // Unit Price
            'F' => 12, // Line Total
            'G' => 12, // Order Total
            'H' => 12, // Status
        ];
    }

    public function title(): string
    {
        return 'Order History';
    }
}
