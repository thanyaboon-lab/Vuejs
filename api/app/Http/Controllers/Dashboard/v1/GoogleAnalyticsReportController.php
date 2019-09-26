<?php

namespace App\Http\Controllers\Dashboard\v1;
// use Laravel\Lumen\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Google_Client;
use Google_Service_AnalyticsReporting;
use Google_Service_AnalyticsReporting_DateRange;
use Google_Service_AnalyticsReporting_Metric;
use Google_Service_AnalyticsReporting_ReportRequest;
use Google_Service_AnalyticsReporting_GetReportsRequest;
use Google_Service_AnalyticsReporting_Dimension;
use Fusonic\Linq\Linq;



class GoogleAnalyticsReportController extends Controller
{
    protected $masterData;
    protected $VIEW_ID_;

    public function __construct(Request $request)
    {
        $this->masterData = $request->master;
        $this->VIEW_ID_ = "197801095";
    }

    /**
     * Initializes an Analytics Reporting API V4 service object.
     *
     * @return An authorized Analytics Reporting API V4 service object.
     */
    public function initializeAnalytics()
    {

        // Use the developers console and download your service account
        // credentials in JSON format. Place them in this directory or
        // change the key file location if necessary.
        //$KEY_FILE_LOCATION = __DIR__ . '/../Json/voltaic-sandbox-210411-5dc8146f2101.json';
        $KEY_FILE_LOCATION = [
            "type" => "service_account",
            "project_id" => "manifest-shade-245409",
            "private_key_id" => "dd332c79ad6c8c047fdb63818d70f33d2264207e",
            "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDCoUsNC86Rs72L\nwUJtFUkJ3N5SE2TrrOmIk9UswvYvZsMxKjzULUPCqDd/eer75WRTwH9axlCyxjJ8\nkIj91aThofSUOzr95OX/ycHtVCJg198cYBdw9chiLjaONJUjHA3YvRnhnFpGki/z\nvMFuaC1o/QF/kvSKV8oC8rcfUvQ1NgTOogyPDYKjid7hOCtcl1dbhuq1GCM/G3Fl\nJN6LuO2OVhh+10ECAiKf8ZEsTIIWujq5zLpZyq4zs0UafNYml+I599mfVT1qBMOe\nD20VD5EcG6EuSh9AzIZMbbH7kTs8MdWLjUL8w/hrMVdWcTrc8EjEbGm/3/aYH6qV\nUyB94cQ7AgMBAAECggEAVoOS1FhAuMRwR2yfBdUV09QBYPNtA1OntUWdVxnMi9J+\nhl6zjk8WlTLoBHqhqNnVSGNDWQrZOTZfn74xnr92XLN8f916Qfya/iHlWYTyCSE7\n9CWElfoy2e2X44tdFa+1OfgIxqAVAtSdixcG1nhpYwc/wMEGgW43hir0mnBpzDKR\nKnrFTpz5Q4GNEarU4ondH7D9/FPlMryRl4KbyrMaIorybwesC2xTTZgOeh0B7uaa\nzOU3Twohfa51m2PiFFbxyNknUdYIS1wYxZ5tGTLTBcxCIXyv7+0K4JvHQ1YZG0Ml\nytC7nBaWSAjY4wml54iSEp7R5xZOqje7peoUYUYsAQKBgQDzjs8nGuc+xhX2oLVt\nOR4Mzkml8iHQP34xeKxCYZSXJdaPK5NCP4gV0EI1OIACLboffDmk2dBJpIP9weS+\n6OgaujVKXAu70ii0vZ27fsW7X3Cy+Si80QdjDylI6dyAaInofaE8Z/EQlndq1AiR\nFHkIvS2/fbzIm9fROHdhmqIYOwKBgQDMkp44Vzaf4tLd64r+c+kBAJPPBmi9htVO\n5bdLcS/19QSOfz4vkOFBcjYH2QkxFt9AbiPMdVhwXObUfdzs53GNXrf5KxmlpVYo\nftiDQcuEnKWokkOziIMamqK1WIFvrx5jfK/SUn4Fhg6rSs76t292lvXc48S4791O\nxj9rAXBEAQKBgCriAyE8gGiyEd3pr+f6PYs9qwP33PJAq6RkPdg2PCZcuClfH79z\nVi+ZCn86Ynd/u5ydj7yxyRWeTMsaH39pnKxQCt/70ukP+LDSDfqcOI5kIICyk/Si\nzS0o1zkKTBOj1FxF+mSbXHtyMrZxfMymkSTzwiFMLzgXEGm7CnH5+v5PAoGBALEz\nT1n+MZLNJ1qTbRJ71JjJpz7sjk2dPafZ06vFn4WtdwT3syYAmR3XkHW7yfp7lWZ6\nAQhZnQG3dzsYywVqdTG/mhx6+PxC+x6YwXLwyxlTlysthvc8iFPDHq12vKfBSNFk\nb+f/DKo8NPirFB6YRjSzDsUHhp+rJkfV8Zj+5gABAoGBAJFVpNgS6hXdv2sNs01/\npXVNaQZDY45+Cpce5qIXnXh6cT8YaRHsWoDrDs91oxGBynSEDEZpxiURpEoHgJMX\n2EuctGGMYuKp8iRcfD7QqkGeTUwWfhfKFuutPhzdWm8rTB2+xgoaVd1jU70/hPGs\nJEsPYTrBl56MbJmHYHT9cs5e\n-----END PRIVATE KEY-----\n",
            "client_email" => "uat-web-dtn-go-th@manifest-shade-245409.iam.gserviceaccount.com",
            "client_id" => "106206982837037585709",
            "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
            "token_uri" => "https://oauth2.googleapis.com/token",
            "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
            "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/uat-web-dtn-go-th%40manifest-shade-245409.iam.gserviceaccount.com"
        ];

        // Create and configure a new client object.
        $client = new Google_Client();
        $client->setApplicationName("Hello Analytics Reporting");
        $client->setAuthConfig($KEY_FILE_LOCATION);
        $client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
        $analytics = new Google_Service_AnalyticsReporting($client);

        return $analytics;
    }


    /**
     * Queries the Analytics Reporting API V4.
     *
     * @param service An authorized Analytics Reporting API V4 service object.
     * @return The Analytics Reporting API V4 response.
     */
    public function getReport($analytics)
    {

        // Replace with your view ID, for example XXXX.
        $VIEW_ID = $this->VIEW_ID_;

        // Create the DateRange object.
        $dateRange = new Google_Service_AnalyticsReporting_DateRange();
        $dateRange->setStartDate("30daysAgo");
        $dateRange->setEndDate("today");

        // Create the Metrics object.
        $sessions = new Google_Service_AnalyticsReporting_Metric();
        $sessions->setExpression("ga:avgSessionDuration");
        $sessions->setAlias("AvgSessions");


        $sessions2 = new Google_Service_AnalyticsReporting_Metric();
        $sessions2->setExpression("ga:users");
        $sessions2->setAlias("users");



        // Create the ReportRequest object.
        $request = new Google_Service_AnalyticsReporting_ReportRequest();
        $request->setViewId($VIEW_ID);
        $request->setDateRanges($dateRange);
        $request->setMetrics(array($sessions));


        $request2 = new Google_Service_AnalyticsReporting_ReportRequest();
        $request2->setViewId($VIEW_ID);
        $request2->setDateRanges($dateRange);
        $request2->setMetrics(array($sessions2));

        $body = new Google_Service_AnalyticsReporting_GetReportsRequest();
        $body->setReportRequests(array($request, $request2));
        return $analytics->reports->batchGet($body);
    }


    public function setReportUertPerDate($analytics)
    {

        // Replace with your view ID, for example XXXX.
        $VIEW_ID = $this->VIEW_ID_;

        // Create the DateRange object.
        $dateRange = new Google_Service_AnalyticsReporting_DateRange();
        $dateRange->setStartDate("30daysAgo");
        $dateRange->setEndDate("today");


        $sessions = new Google_Service_AnalyticsReporting_Metric();
        $sessions->setExpression("ga:users");
        $sessions->setAlias("users");

        // Create the Metrics object.
        $browser = new Google_Service_AnalyticsReporting_Dimension();
        $browser->setName("ga:date");



        // Create the ReportRequest object.
        $request = new Google_Service_AnalyticsReporting_ReportRequest();
        $request->setViewId($VIEW_ID);
        $request->setDateRanges($dateRange);
        $request->setDimensions(array($browser));
        $request->setMetrics(array($sessions));

        $body = new Google_Service_AnalyticsReporting_GetReportsRequest();
        $body->setReportRequests(array($request));
        return $analytics->reports->batchGet($body);
    }






    public function printResultsWebsiteVisitorsCounterAndAverageVisitTime($reports)
    {
        $AvgSessions = 0;
        $users = 0;
        for ($reportIndex = 0; $reportIndex < count($reports); $reportIndex++) {
            $report = $reports[$reportIndex];
            $header = $report->getColumnHeader();
            $dimensionHeaders = $header->getDimensions();
            $metricHeaders = $header->getMetricHeader()->getMetricHeaderEntries();
            $rows = $report->getData()->getRows();

            for ($rowIndex = 0; $rowIndex < count($rows); $rowIndex++) {
                $row = $rows[$rowIndex];
                $dimensions = $row->getDimensions();
                $metrics = $row->getMetrics();
                /*
            for ($i = 0; $i < count($dimensionHeaders) && $i < count($dimensions); $i++) {
                print($dimensionHeaders[$i] . ": " . $dimensions[$i] . "\n");
            }
        */
                for ($j = 0; $j < count($metrics); $j++) {
                    $values = $metrics[$j]->getValues();
                    for ($k = 0; $k < count($values); $k++) {
                        $entry = $metricHeaders[$k];
                        //  print($entry->getName() . ": " . $values[$k] . "\n");
                        if ($entry->getName() == 'AvgSessions') {
                            $AvgSessions = floatval($values[$k]);
                        }
                        if ($entry->getName() == 'users') {
                            $users = intVal($values[$k]);
                        }
                    }
                }
            }
        }
        $data = [
            'AvgSessions' => 200, //$AvgSessions,
            'users' => 500 //$users
        ];
        return $data;
    }

    public function DateThai($strDate)

    {

        $strYear = date("Y", strtotime($strDate)) + 543;

        $strMonth = date("n", strtotime($strDate));

        $strDay = date("j", strtotime($strDate));
        $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");

        $strMonthThai = $strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
    }

    public function printResultsReportUertPerDate($reports)
    {
        $data_date = [];
        $data_user = [];
        for ($reportIndex = 0; $reportIndex < count($reports); $reportIndex++) {
            $report = $reports[$reportIndex];
            $header = $report->getColumnHeader();
            $dimensionHeaders = $header->getDimensions();
            $metricHeaders = $header->getMetricHeader()->getMetricHeaderEntries();
            $rows = $report->getData()->getRows();

            for ($rowIndex = 0; $rowIndex < count($rows); $rowIndex++) {
                $row = $rows[$rowIndex];
                $dimensions = $row->getDimensions();
                $metrics = $row->getMetrics();

                for ($i = 0; $i < count($dimensionHeaders) && $i < count($dimensions); $i++) {
                    array_push(
                        $data_date,
                        self::DateThai(date("Y-m-d", strtotime($dimensions[$i])))
                    );
                    //   print($dimensionHeaders[$i] . ": " . date("Y-m-d", strtotime($dimensions[$i]))  . "\n");
                }

                for ($j = 0; $j < count($metrics); $j++) {
                    $values = $metrics[$j]->getValues();
                    for ($k = 0; $k < count($values); $k++) {
                        $entry = $metricHeaders[$k];
                        array_push(
                            $data_user,
                            intVal($values[$k])
                        );
                        // print($entry->getName() . ": " . $values[$k] . "\n");

                    }
                }
            }
        }

        $data = [
            'Category' => $data_date,
            'users' => $data_user
        ];


        return $data;
    }

    public function getCountMember(Request $request)
    {
        //  $current_user = Guard::auth(); 
        $dateNow = date("Y-m-d");
        $month_now = intval(date("m", strtotime($dateNow)));
        $month_before = date("Y-m-d", strtotime(date("Y-m-d", strtotime($dateNow)) . "-1 month"));
        $month_before = intval(date("m", strtotime($month_before)));;

        $getMemberList = Member::orderBy('created_at', 'desc');
        $getMemberList = $getMemberList->get();
        $total_month_now = 0;
        $total_month_before = 0;
        foreach ($getMemberList as $item) {
            if (intval(date("m", strtotime($item['created_at']))) == $month_now) {
                $total_month_now += 1;
            }

            if (intval(date("m", strtotime($item['created_at']))) == $month_before) {
                $total_month_before += 1;
            }
        }
        $totalCount = $total_month_now + $total_month_before;
        $Count = [
            'totalCount' => $totalCount,
            'total_month_before' => $total_month_before,
            'total_month_now' => $total_month_now,
            'percent' => $total_month_before == 0 ? 0 : (($total_month_now - $total_month_before) / $total_month_before) * 100,


            //  'member_detail'=>$getMemberList
        ];
        if ($Count) {
            $data = [
                'result' => $Count
            ];
            return responder()->success($data)->respond(200);
        }
        return responder()->error()->respond(404);
    }


    public function getWebsiteVisitorsCounterAndAverageVisitTime(Request $request)
    {
        //  $current_user = Guard::auth(); 
        $analytics = self::initializeAnalytics();
        $response = self::getReport($analytics);
        $GA_Data = self::printResultsWebsiteVisitorsCounterAndAverageVisitTime($response);
        $data = $GA_Data;

        return responder()->success($data)->respond(200);
        //  print_r($response);
    }

    public function getWebsiteVisitorsLinechartPerDay(Request $request)
    {
        // $current_user = Guard::auth(); 
        $analytics = self::initializeAnalytics();
        $response = self::setReportUertPerDate($analytics);
        $GA_Data = self::printResultsReportUertPerDate($response);
        $data = $GA_Data;

        return responder()->success($data)->respond(200);
        //  print_r($response);
    }
    public function getsimpleData(Request $request)
    {
        $data = [
            [
                'username' => "สมชาย ใจดี",
                'registered' => "2012/01/01",
                'min' => 0,
                'rate' => 0.0,
                'price' => 0.0,
                'status' => "Active"
            ],
            [
                'username' => "ประยุท โอตะ",
                'registered' => "2012/01/01",
                'min' => 0,
                'rate' => 0.0,
                'price' => 0.0,
                'status' => "Banned"
            ],
            [
                'username' => "Chetan Mohamed",
                'registered' => "2012/01/01",
                'min' => 0,
                'rate' => 0.0,
                'price' => 0.0,
                'status' => "Inactive"
            ],
            [
                'username' => "Derick Maximinus",
                'registered' => "2012/01/01",
                'min' => 0,
                'rate' => 0.0,
                'price' => 0.0,
                'status' => "Pending"
            ],
            [
                'username' => "Yiorgos Avraamu",
                'registered' => "2012/01/01",
                'min' => 0,
                'rate' => 0.0,
                'price' => 0.0,
                'status' => "Pending"
            ],

        ];

        return responder()->success($data)->respond(200);
        //  print_r($response);
    }

    public function SearchData(Request $request)
    {

        $input = $request->all();
        if($input){
            $data =  [
                [
                    'username' => "สมชาย ใจดี",
                    'registered' => "2012/01/01",
                    'min' => 0,
                    'rate' => 0.0,
                    'price' => 0.0,
                    'status' => "Active"
                ],
                [
                    'username' => "ประยุท โอตะ",
                    'registered' => "2012/01/01",
                    'min' => 0,
                    'rate' => 0.0,
                    'price' => 0.0,
                    'status' => "Banned"
                ],
                [
                    'username' => "Chetan Mohamed",
                    'registered' => "2012/01/01",
                    'min' => 0,
                    'rate' => 0.0,
                    'price' => 0.0,
                    'status' => "Inactive"
                ],
                [
                    'username' => "Derick Maximinus",
                    'registered' => "2012/01/01",
                    'min' => 0,
                    'rate' => 0.0,
                    'price' => 0.0,
                    'status' => "Pending"
                ],
                [
                    'username' => "Yiorgos Avraamu",
                    'registered' => "2012/01/01",
                    'min' => 0,
                    'rate' => 0.0,
                    'price' => 0.0,
                    'status' => "Pending"
                ],
    
            ];
            $txt = $input['txt'];
            if(isset($txt) && $txt != ''){
                $members = Linq::from($data)->where(function ($member) use ($txt) {
                    return (strpos($member['username'], $txt) !== false);
                })->toArray();
                return responder()->success($members)->respond(200);
            } else {
                $members = Linq::from($data)->toArray();
                return responder()->success($members)->respond(200);
            }
        }
    }
}
