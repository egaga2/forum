<?php

namespace App\Http\Controllers;

use App\Answers;
use App\AwardedBadges;
use App\AwnserReplies;
use App\Badges;
use App\Categories;
use App\News;
use App\Questions;
use App\QuestionsReplies;
use App\User;
use App\VotedAnswers;
use App\VotedQuestions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use File;

class CronjobController extends Controller
{


    public function __construct()
    {

    }

    public function award()
    {
        $this->participationAward();
        $this->answersAward();
        $this->questionsAward();
        dd('done');
    }

    private function questionsAward()
    {
        $users = User::where('status', 1)->orderBy('badgesUpdateQ', 'ASC')->pluck('id');
        $badges = Badges::orderBy('id', 'ASC')->get();
        $Usercols = ['badgesGold', 'badgesGold', 'badgesSilver', 'badgesBronze'];
        foreach ($users as $index => $value) {
            $userid = $value;
            $awardedBadges = AwardedBadges::where('userid', $userid)->get()->toArray();
            $datacheck = [];
            foreach ($awardedBadges as $r) {
                array_push($datacheck, $r['badgeId']);
            }
            foreach ($badges as $badge) {
                $badgeId = $badge->id;
                if (in_array($badgeId, $datacheck)) {
                    continue;
                }
                if ($badgeId == 1 || $badgeId == 2 || $badgeId == 3 || $badgeId == 4) {
                    $awardedBadges = Questions::where('userid', $userid)->where('votes', '>=', $badge['value'])->count();
                    if ($awardedBadges > 0) {
                        $UsercolsP = $Usercols[$badge['priority']];
                        $this->manageAwardedBadgeDB($badgeId, $UsercolsP, $userid);
                    }
                } else if ($badgeId == 5) {
                    $awardedBadgesV = Questions::where('userid', $userid)->where('views', '>=', $badge['value'])->count();
                    if ($awardedBadgesV > 0) {
                        $UsercolsP = $Usercols[$badge['priority']];
                        $this->manageAwardedBadgeDB($badgeId, $UsercolsP, $userid);
                    }
                } else if ($badgeId == 7) {
                    $awardedBadgesF = Questions::select('votes')->where('userid', $userid)->orderBy('on', 'asc')->First();
                    if ($awardedBadgesF != null) {
                        if ($awardedBadgesF['votes'] > $badge['value']) {
                            $UsercolsP = $Usercols[$badge['priority']];
                            $this->manageAwardedBadgeDB($badgeId, $UsercolsP, $userid);
                        }
                    }
                }
                User::where('id', $userid)->update(['badgesUpdateQ' => date('Y-m-d H:i:s')]);

            }
        }
    }

    private function answersAward()
    {
        $users = User::where('status', 1)->orderBy('badgesUpdateA', 'ASC')->pluck('id');
        $badges = Badges::get();
        $Usercols = ['badgesGold', 'badgesGold', 'badgesSilver', 'badgesBronze'];
        foreach ($users as $index => $value) {
            $userid = $value;
            $awardedBadges = AwardedBadges::where('userid', $userid)->get()->toArray();
            $datacheck = [];
            foreach ($awardedBadges as $r) {
                array_push($datacheck, $r['badgeId']);
            }
            foreach ($badges as $index => $badge) {
                $badgeId = $badge->id;

                if (in_array($badgeId, $datacheck)) {
                    continue;
                }
                if ($badgeId == 9 || $badgeId == 10 || $badgeId == 11 || $badgeId == 12 || $badgeId == 14) {
                    $awardedBadges = Questions::where('userid', $userid)->where('votes', '>=', $badge['value'])->count();
                    if ($awardedBadges > 0) {
                        $UsercolsP = $Usercols[$badge['priority']];
                        $this->manageAwardedBadgeDB($badgeId, $UsercolsP, $userid);
                    }
                } else if ($badgeId == 13) {
                    $awardedBadgesV = Answers::where('userid', $userid)->where('votes', '>=', $badge['value'])->count();
                    if ($awardedBadgesV > 0) {
                        $UsercolsP = $Usercols[$badge['priority']];
                        $this->manageAwardedBadgeDB($badgeId, $UsercolsP, $userid);
                    }
                }
                User::where('id', $userid)->update(['badgesUpdateA' => date('Y-m-d H:i:s')]);
            }
        }
    }

    private function participationAward()
    {
        $users = User::where('status', 1)->orderBy('badgesUpdateP', 'ASC')->pluck('id');
        $badges = Badges::get();
        $Usercols = ['badgesGold', 'badgesGold', 'badgesSilver', 'badgesBronze'];
        foreach ($users as $index => $value) {
            $userid = $value;
            $awardedBadges = AwardedBadges::where('userid', $userid)->get()->toArray();
            $datacheck = [];
            foreach ($awardedBadges as $r) {
                array_push($datacheck, $r['badgeId']);
            }
            foreach ($badges as $badge) {
                $badgeId = $badge->id;
                if (in_array($badgeId, $datacheck)) {
                    continue;
                }
                if ($badgeId == 16) {
                    $commentsCheck = AwnserReplies::where('userid', $userid)->count();
                    if ($commentsCheck >= $badge['value']) {
                        $UsercolsP = $Usercols[$badge['priority']];
                        $this->manageAwardedBadgeDB($badgeId, $UsercolsP, $userid);
                    }
                } else if ($badgeId == 17) {
                    $commentsCheck = AwnserReplies::where('userid', $userid)->where('votes', '>=', 5)->count();
                    if ($commentsCheck >= $badge['value']) {
                        $UsercolsP = $Usercols[$badge['priority']];
                        $this->manageAwardedBadgeDB($badgeId, $UsercolsP, $userid);
                    } else {
                        $commentsCheck = QuestionsReplies::where('userid', $userid)->where('votes', '>=', 5)->count();
                        if ($commentsCheck >= $badge['value']) {
                            $UsercolsP = $Usercols[$badge['priority']];
                            $this->manageAwardedBadgeDB($badgeId, $UsercolsP, $userid);
                        }
                    }
                } else if ($badgeId == 15) {
                    $aboutmeCheck = User::where('id', $userid)->whereRaw('description <> ""')->count();
                    if ($aboutmeCheck > 0) {
                        $UsercolsP = $Usercols[$badge['priority']];
                        $this->manageAwardedBadgeDB($badgeId, $UsercolsP, $userid);
                    }
                } else if ($badgeId == 19) {
                    $yearlyCheck = $this->checkActiveMemberYear($badge['value'], $userid);
                    if ($yearlyCheck > 0) {
                        $UsercolsP = $Usercols[$badge['priority']];
                        $this->manageAwardedBadgeDB($badgeId, $UsercolsP, $userid);
                    }
                }
                User::where('id', $userid)->update(['badgesUpdateA' => date('Y-m-d H:i:s')]);
            }
        }
    }

    private function checkActiveMemberYear($votes, $userid)
    {
        $date = Carbon::today()->subYears(1);
        return User::where('id', $userid)->where('votes', '>=', $votes)->whereDate('on', '<=', $date)->count();
    }

    private function manageAwardedBadgeDB($badgeId, $UsercolsP, $userid)
    {
        DB::table('awardedBadges')->insert(['userid' => $userid, 'badgeId' => $badgeId]);
        User::find($userid)->increment($UsercolsP);
        DB::table('notifications')->insert(['for' => $userid, 'badgeId' => $badgeId, 'nsId' => 11]);
    }

    public function cronQuestion()
    {
//        for ($k = 0; $k < 10000; $k++) {
//            for ($i = 1; $i <= 100; $i++) {
//                $userid = $i;
//                $question = rand(1, 2289);
//                $answers = rand(1, 32000);
//                if (VotedQuestions::where('by', $userid)->where('qid', $question)->count() <= 0 && Questions::where('id',$question)->count()>0) {
//                    $vote = new VotedQuestions;
//                    $vote->by = $userid;
//                    $vote->qid = $question;
//                    $vote->val = 1;
//                    $vote->save();
//                    Questions::find($question)->increment('votes');
//                }
//                if (VotedAnswers::where('by', $userid)->where('qaid', $answers)->count() <= 0 && Answers::where('id',$answers)->count()>0) {
//                    $answer = new VotedAnswers;
//                    $answer->by = $userid;
//                    $answer->qaid = $answers;
//                    $answer->val = 1;
//                    $answer->save();
//                    Answers::find($answers)->increment('votes');
//                }
//            }
//        }
//        dd('done');
//
//        $cat = ['web', 'php', 'javascript', 'jquery', 'codeigniter', 'java', 'html', 'css', 'c#', 'data-structures', 'ajax', 'sql',
//            'mongodb', 'wordpress', 'andriod', 'python', 'angularjs', 'node.js', 'swift', 'vb.net', 'reactjs', 'websocket', 'yii',
//            'cordova', 'ios', 'xamarin', 'numpy', 'jython', 'scipy', 'asp.net-core', 'asp.net-mvc', 'linq', 'xml', 'drupal', 'firebase', 'joomla', 'shell', 'nightwatch'
//            , 'api', 'matlab', 'nativescript', 'git', 'linux', 'mysql', 'docker', 'github', 'r', 'math', 'editor', 'Assembly'];
//        foreach ($cat as $c) {
//            $url = 'https://stackoverflow.com/questions/tagged/' . $c . '?tab=votes&pagesize=50';
//            $client = new Client();
//            $crawler = $client->request('GET', $url);
//            $crawler->filter('div.summary h3 > a')->each(function ($node) {
//                $title = $node->text();
//                $title = encodeContent($title);
//                $slug = Str::slug($title);
//                if (empty($slug))
//                    $slug = str_slug($title);
//                if (Questions::where('permalink', $slug)->count() <= 0) {
//                    $url = $node->attr('href');
//                    $data = $this->getcontent('https://stackoverflow.com' . $url);
//                    sleep(2);
//                    $content = $data['content'];
//                    $tags = $data['tag'];
//                    $tag = explode(',', $tags);
//                    $answer = $data['answer'];
//                    $cat = Categories::whereIn('permalink', $tag)->First();
//                    if ($cat != null) {
//                        $catid = $cat['id'];
//                    } else $catid = 85;
//                    $description = encodeContent($content[0]);
//                    $userid = rand(1, 100);
//                    $question = new Questions;
//                    $question->title = $title;
//                    $question->permalink = $slug;
//                    $question->catid = $catid;
//                    $question->userid = $userid;
//                    $question->status = 1;
//                    $question->description = $description;
//                    $question->tags = $tags;
//                    $question->views = rand(200, 3000);
//                    $question->save();
//                    if (count($answer) > 0) {
//                        foreach ($answer as $k => $v) {
//                            $answerEditor = encodeContent($v);
//                            $answers = new Answers;
//                            $answers->qid = $question->id;
//                            $answers->body = $answerEditor;
//                            $answers->userid = rand(1, 100);
//                            $answers->save();
//                            Questions::find($question->id)->increment('awnsers');
//                        }
//                    }
//                }
//            });
//        }
//        dd('done');
    }

    private function getcontent($url)
    {
        $client = new Client();
        $crawler = $client->request('GET', $url, [
            'timeout' => 1,
        ]);
        $content = '';
        $tag = '';
        $content = $crawler->filter('div.postcell > .s-prose')->each(function ($node) {
            return $node->html();
        });
        $tag = $crawler->filter('div.post-taglist div > a')->each(function ($node) {
            return $node->text();
        });
        $answer = $crawler->filter('div.answercell > .s-prose')->each(function ($node) {
            return $node->html();
        });
        $data['content'] = $content;
        $tags = implode(',', $tag);
        $data['tag'] = $tags;
        $data['answer'] = $answer;
        return $data;
    }
}
