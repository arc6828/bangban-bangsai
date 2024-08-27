<?php

namespace App\Models;

use Carbon\Carbon;
use finfo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LineMessageAPI extends Model
{
    use HasFactory;


    public  function replyUser($requestData)
    {
        // for verify only
        if (count($requestData["events"]) == 0)  return;
        $event = $requestData["events"][0];

        $messages = [];
        switch ($event["message"]["type"]) {
            case "text":
                $text = $event["message"]["text"];
                if (str_contains($text, "ปัจจุบัน")) {
                    $m_carousel = $this->replyWithFlexCarousel($event);
                    $messages[] = $m_carousel;
                    $m_link = $this->replyWithText($event, "https://thungsongflood.org");
                    $messages[] = $m_link;
                } else if (str_contains($text, "คาดการณ์")) {
                    $m_bubble = $this->replyWithFlexBubble($event);
                    $messages[] = $m_bubble;
                    $m_link = $this->replyWithText($event, "https://thungsongflood.org/statistic");
                    $messages[] = $m_link;
                } else if (str_contains($text, "ภาพถ่าย") || str_contains($text, "ถ่ายภาพ")) {
                    $messages[] = $this->replyWithQuickReply($event, "quick_reply.json");
                } else {
                    $messages[] = $this->replyWithText($event, "Hello World");
                }
                break;
            case "location":
                // $this->replyWithFlexCarousel($event);
                $messages[] = $this->replyLocation($event);
                break;
            case "sticker":
                $messages[] = $this->replyWithFlexBubble($event);
                break;
            case "image":
                $messages[] = $this->replyImage($event);
                break;
        }
        $this->replyMessages($event, $messages);

        // ------- BACKGROUND PROCESS -----------

        // GET USER
        $userId = $event["source"]["userId"];
        $user = $this->getProfile($userId);

        $requestData = [
            // "userId" => $user->userId,
            "displayName" => $user->displayName,
            "pictureUrl" => $user->pictureUrl,
            "statusMessage" => $user->statusMessage,
            "language" => $user->language,
        ];

        // LineUser::create($requestData);
        LineUser::firstOrCreate(
            ['userId' => $userId],
            $requestData
        );
    }

    public  function replyWithQuickReply($event, $filename)
    {
        $template_path = storage_path('../public/json/' . $filename);
        $string_json = file_get_contents($template_path);
        $message = json_decode($string_json, true);
        return $message;
        // $this->reply($event, $message);
    }
    public  function replyWithFlexCarousel($event)
    {
        // $template_path = storage_path('../public/flex-templates/now.json');
        // $string_json = file_get_contents($template_path);
        // custom
        $json = [
            "type" => "carousel",
            "contents" => []
        ];
        $template_path = storage_path('../public/flex-templates/waterlevel.json');
        $template_bubble = json_decode(file_get_contents($template_path), true);
        // $json["contents"] = [];
        // data        
        $data = json_decode(file_get_contents("https://thungsongflood.org/api/now/wl"), true);
        foreach ($data as $item) {
            $b = array_merge([], $template_bubble);
            $json["contents"][] = $this->injectBubble($b, $item);
        }

        // end custom
        $message = [
            "type" => "flex",
            "altText" => "สถานีระดับน้ำในอำเภอทุ่งสงล่าสุด",
            "contents" => $json,
        ];

        return $message;
        // $this->reply($event, $message);
    }

    public function injectBubble($b, $item)
    {
        // สถานีระดับน้ำ
        $b["body"]["contents"][0]["text"] .= " ({$item["station"]["id"]})";
        $b["body"]["contents"][1]["text"] = "{$item["station"]["tele_station_name"]["th"]}";

        // location,
        $b["body"]["contents"][2]["text"] = "ต.{$item["geocode"]["tumbon_name"]["th"]} อ.{$item["geocode"]["amphoe_name"]["th"]} จ.{$item["geocode"]["province_name"]["th"]}";

        // ------------------------------

        // date "waterlevel_datetime": "2023-08-05 19:30",
        $b["body"]["contents"][4]["contents"][0]["contents"][1]["text"] = $item["waterlevel_datetime"];

        // ปริมาณน้ำ "storage_percent": "70.41",
        $b["body"]["contents"][4]["contents"][1]["contents"][1]["text"] = "" . number_format($item["storage_percent"]) . "%";

        // สถานะ
        $situation_level_dict = [
            "1" => "น้ำน้อยวิกฤติ",
            "2" => "น้ำน้อย",
            "3" => "น้ำปานกลาง",
            "4" => "น้ำมาก",
            "5" => "น้ำล้นตลิ่ง",
        ];
        $b["body"]["contents"][4]["contents"][2]["contents"][1]["text"] = $situation_level_dict[$item["situation_level"]];

        // diff_wl_bank_text
        $b["body"]["contents"][4]["contents"][3]["contents"][0]["text"] = $item["diff_wl_bank_text"];

        // diff_wl_bank
        $b["body"]["contents"][4]["contents"][3]["contents"][1]["text"] = $item["diff_wl_bank"];

        // ------------------------------

        // ระดับตลิ่ง
        $b["body"]["contents"][4]["contents"][5]["contents"][1]["text"] = "" . number_format($item["station"]["min_bank"], 1);

        // ระดับน้ำ
        $b["body"]["contents"][4]["contents"][6]["contents"][1]["text"] = "" . number_format($item["waterlevel_msl"], 1);

        // ระดับท้องน้ำ
        $b["body"]["contents"][4]["contents"][7]["contents"][1]["text"] = "" . number_format($item["station"]["ground_level"], 1);

        // ------------------------------

        // map https://www.google.com/maps/@14.1546271,100.6159917,15z
        $b["body"]["contents"][4]["contents"][9]["contents"][0]["action"]["uri"] = "https://www.google.com/maps/@{$item["station"]["tele_station_lat"]},{$item["station"]["tele_station_long"]},15z";

        // ------------------------------
        // id
        $b["body"]["contents"][6]["contents"][1]["text"] = "#" . $item["id"];


        // agency
        $b["body"]["contents"][7]["contents"][0]["text"] = $item["agency"]["agency_name"]["th"];


        return $b;
    }
    public  function replyWithFlexBubble($event)
    {
        $template_path = storage_path('../public/flex-templates/waterlevel.json');
        $json = json_decode(file_get_contents($template_path), true);
        // data        
        $data = json_decode(file_get_contents("https://thungsongflood.org/api/now/wl"), true);
        $data = array_filter($data, function ($item) {
            return $item["station"]["id"] == "795"; //ทุ่งสง
        });
        //
        foreach ($data as $item) {
            $json = $this->injectBubble($json, $item);
            break;
        }
        $json["body"]["contents"][4]["contents"][8] = $json["body"]["contents"][4]["contents"][7];
        $json["body"]["contents"][4]["contents"][8]["contents"][0]["text"] = "ระดับน้ำคาดการณ์";
        $json["body"]["contents"][4]["contents"][8]["contents"][1]["text"] = "+ 0.5 เมตร/ชม.";

        $message = [
            "type" => "flex",
            "altText" => "bubble",
            "contents" => $json,
        ];

        return $message;
        // $this->reply($event, $message);
    }

    public  function replyLocation($event)
    {
        $requestData = [
            // "title" => $event["message"]["title"],
            "address" => $event["message"]["address"],
            "latitude" => $event["message"]["latitude"],
            "longitude" => $event["message"]["longitude"],
            "owner" => $event["source"]["userId"],
        ];

        UserLocation::create($requestData);

        // UPDATE IMAGE STATION within 30 minutes of this user
        // get latest image of this user
        $image = StationImage::where('owner', $requestData['owner'])->latest()->first();
        if (isset($image)) {
            // $newYear = new Carbon('2023-11-30 12:18:34')

            // get  latest location of this user
            $location = UserLocation::where('owner', $requestData['owner'])->latest()->first();

            // $newYear = new Carbon('2023-11-30 12:18:34')
            // $newYear->diffInMinutes($oldYear)
            // diff minutes < 30 min
            $image_created_at = new Carbon($image->created_at);
            $location_created_at = new Carbon($location->created_at);
            $diff_minutes =  $image_created_at->diffInMinutes($location_created_at);
            if ($diff_minutes <= 30 ) {
                // update nearest location
                // $image->station_code = 795;
                // $image->save();
            }
        }



        // Reply with something
        $message = [
            "type" => "text",
            "text" => "ส่งตำแหน่งสำเร็จ",
        ];
        return $message;
        // $this->reply($event, $message);
    }

    public  function replyImage($event)
    {
        $requestData = [
            "url" => $this->getImageFromLine($event["message"]["id"]),
            "owner" => $event["source"]["userId"],
            "station_code" => "795",    // default or pick from last share location
        ];
        if (true) {
            // $requestData['url'] = $request->file('url')->store('uploads', 'public');

            // s3
            // $requestData['url'] = $request->file('url')->store('thungsong/uploads','s3');
            // $requestData['url'] = env('AWS_URL')."/".$requestData['url'];
            // content
            $content = $requestData["url"];
            // filepath
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mimeType = $finfo->buffer($content);
            $extension = "." . explode("/", $mimeType)[1];
            $filename = substr(md5(mt_rand()), 0, 32) . $extension;
            $filepath = 'thungsong/uploads/' . $filename;
            // send to s3
            Storage::disk('s3')->put($filepath, $content);
            $requestData['url'] = env('AWS_URL') . "/" . $filepath;
        }

        StationImage::create($requestData);

        // Reply with something
        $message = [
            "type" => "text",
            "text" => "ส่งรูปสำเร็จ",
        ];
        return $message;
        // $this->reply($event, $message);
    }

    public function getImageFromLine($id)
    {
        $opts = array(
            'http' => [
                'method'  => 'GET',
                //'header'  => "Content-Type: text/xml\r\n".
                'header' => 'Authorization: Bearer ' . env('LINE_CHANNEL_ACCESS_TOKEN'),
                //'content' => $body,
                //'timeout' => 60
            ]
        );

        $context  = stream_context_create($opts);
        //https://api-data.line.me/v2/bot/message/11914912908139/content
        $url = "https://api-data.line.me/v2/bot/message/{$id}/content";
        $result = file_get_contents($url, false, $context);
        return $result;
    }

    public  function replyWithText($event, $text)
    {
        $message = [
            "type" => "text",
            "text" => $text,
        ];
        return $message;
        // $this->reply($event, $message);
    }

    public  function reply($event, $message)
    {
        //GET ONLY FIRST EVENT
        $replyToken = $event["replyToken"];

        // echo $event;
        // $channel_access_token = $this->channel_access_token;
        // $event['message'] = ['id' => ''.$data['msgocrid'] ];
        $body = [
            "replyToken" => $replyToken,
            "messages" => [$message],
        ];

        $opts = [
            'http' => [
                'method'  => 'POST',
                'header'  => "Content-Type: application/json \r\n" .
                    'Authorization: Bearer ' . env('LINE_CHANNEL_ACCESS_TOKEN'),
                'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
                //'timeout' => 60
            ]
        ];

        $context  = stream_context_create($opts);
        //https://api-data.line.me/v2/bot/message/11914912908139/content
        $url = "https://api.line.me/v2/bot/message/reply";
        $result = file_get_contents($url, false, $context);
        file_put_contents('../storage/logs/log.txt', $result . PHP_EOL, FILE_APPEND);
    }

    public  function replyMessages($event, $messages)
    {
        //GET ONLY FIRST EVENT
        $replyToken = $event["replyToken"];

        // echo $event;
        // $channel_access_token = $this->channel_access_token;
        // $event['message'] = ['id' => ''.$data['msgocrid'] ];
        $body = [
            "replyToken" => $replyToken,
            "messages" => $messages,
        ];

        $opts = [
            'http' => [
                'method'  => 'POST',
                'header'  => "Content-Type: application/json \r\n" .
                    'Authorization: Bearer ' . env('LINE_CHANNEL_ACCESS_TOKEN'),
                'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
                //'timeout' => 60
            ]
        ];

        $context  = stream_context_create($opts);
        //https://api-data.line.me/v2/bot/message/11914912908139/content
        $url = "https://api.line.me/v2/bot/message/reply";
        $result = file_get_contents($url, false, $context);
        file_put_contents('../storage/logs/log.txt', $result . PHP_EOL, FILE_APPEND);
    }

    public  function getProfile($userId)
    {
        //GET ONLY FIRST EVENT
        // $replyToken = $event["replyToken"];

        // echo $event;
        // $channel_access_token = $this->channel_access_token;
        // $event['message'] = ['id' => ''.$data['msgocrid'] ];
        // $body = [
        //     "replyToken" => $replyToken,
        //     "messages" => [$message],
        // ];

        $opts = [
            'http' => [
                'method'  => 'GET',
                'header'  => "Content-Type: application/json \r\n" .
                    'Authorization: Bearer ' . env('LINE_CHANNEL_ACCESS_TOKEN'),
                // 'content' => json_encode($body, JSON_UNESCAPED_UNICODE),
                //'timeout' => 60
            ]
        ];

        $context  = stream_context_create($opts);
        //https://api-data.line.me/v2/bot/message/11914912908139/content
        // $url = "https://api.line.me/v2/bot/message/reply";
        $url = "https://api.line.me/v2/bot/profile/{$userId}";
        $result = file_get_contents($url, false, $context);
        file_put_contents('../storage/logs/log.txt', $result . PHP_EOL, FILE_APPEND);

        return json_decode($result);
    }
}
