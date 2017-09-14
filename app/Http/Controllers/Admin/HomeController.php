<?php
/**
 * Created by PhpStorm.
 * User: liudian
 * Date: 9/14/17
 * Time: 09:25
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use App\Models\TopUpAdmin;
use App\Models\TopUpPlayer;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $cardTypeId = 1;
    protected $coinTypeId = 2;

    public function summaryReport(AdminRequest $request)
    {
        $data = [];
        //代理商总的购买量
        $data['agent_purchased_total'] = TopUpAdmin::groupBy('type')
                                            ->select('type', DB::raw('SUM(amount) as total'))
                                            ->get()
                                            ->groupBy(function ($item, $key) {
                                                if ($item['type'] == $this->cardTypeId) {
                                                    return '房卡';
                                                } else if ($item['type'] == $this->coinTypeId) {
                                                    return '金币';
                                                }
                                            });

        //玩家总的消耗量
        $data['player_consumed_total'] = TopUpPlayer::groupBy('type')
                                            ->select('type', DB::raw('SUM(amount) as total'))
                                            ->get()
                                            ->groupBy(function ($item, $key) {
                                                if ($item['type'] == $this->cardTypeId) {
                                                    return '房卡';
                                                } else if ($item['type'] == $this->coinTypeId) {
                                                    return '金币';
                                                }
                                            });

        //总的玩家充值人数
        $data['player_total'] = TopUpPlayer::groupBy('type')
                                    ->select('type', DB::raw('COUNT(player) as total'))
                                    ->get()
                                    ->groupBy(function ($item, $key) {
                                        if ($item['type'] == $this->cardTypeId) {
                                            return '房卡';
                                        } else if ($item['type'] == $this->coinTypeId) {
                                            return '金币';
                                        }
                                    });

        return $data;
    }
}