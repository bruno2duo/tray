<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\EmailJob;
use App\Models\Sellers;
use App\Models\Sales;

class EmailController extends Controller
{
    public function send()
    {
        $this->toAdmin();
        $this->toSellers(null);
    }

    public function resend(string $id)
    {
        $this->toSellers($id);
    }

    public function toAdmin()
    {
        $sale_date = date('Y-m-d');
        $sales = Sales::where('sale_date', $sale_date)->get();

        if($sales) {   
            $total_amount = 0;
            foreach($sales as $sale) {
                $total_amount += $sale['amount'];
            }
            
            $email_to = 'admin@tray.com';
            $subject = 'Relatório geral de vendas';
            $content = 'Valor total das vendas do dia ' . $sale_date . ' : R$ ' . $total_amount;
            
            $email_job = new EmailJob($email_to, $subject, $content);
            
            try {
                $email_job->handle();
                return true;
            } catch (\Exception $e) {
                return 'Erro ao executar o Job para enviar o e-mail: ' . $e->getMessage();
            }
        }
    }

    public function toSellers($id = null)
    {
        $sale_date = date('Y-m-d');

        if($id) $sellers = Sellers::where('id', $id)->get();
        else $sellers = Sellers::all();

        foreach($sellers as $seller) {
            $sales = Sales::where('seller_id', $seller['id'])
                            ->where('sale_date', $sale_date)->get();

            $total_commission = 0;
            $total_amount = 0;
            $total_sales = count($sales);

            foreach($sales as $sale) {
                $total_amount += $sale['amount'];
                $total_commission += $sale['total_commission'];
            }
            
            $email_to = $seller['email'];
            $subject = 'Relatório de vendas';
            $content = 'Total de vendas : ' . $total_sales . ' - Valor total das vendas : R$ ' . $total_amount . ' - Total de comissão : R$ ' . $total_commission;
            
            $email_job = new EmailJob($email_to, $subject, $content);
            
            try {
                $email_job->handle();
            } catch (\Exception $e) {
                return 'Erro ao executar o Job para enviar o e-mail: ' . $e->getMessage();
            }
        }
    }
}
