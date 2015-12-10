<?php
/**
 * Created By Dara on 6/12/2015
 * Rate Config
 */
return [
    'skill'=>[
        'name'=>'skill',
        'result'=>[
            5=>4.8,
            4=>3.3,
            3=>2,
            2=>1,
            1=>0.5
        ]
    ],
    'endorse'=>[
        'name'=>'endorse',
        'weight'=>70,
        'result'=>[
            5=>1600,
            4=>1000,
            3=>600,
            2=>300,
            1=>100
        ],
        'attributes'=>[
            3=>[
                'name'=>'firstLevel', //all categories similar
                'conditions'=>[
                    5=>['name'=>'fiveStar','value'=>150,'max_value'=>450], //5 star endorser skill
                    4=>['name'=>'fourStar','value'=>100,'max_value'=>300], //4 star endorser skill
                    3=>['name'=>'threeStar','value'=>70,'max_value'=>210], //3 star endorser skill
                    2=>['name'=>'twoStar','value'=>40,'max_value'=>120], //2 star endorser skill
                    1=>['name'=>'oneStar','value'=>25,'max_value'=>75]  //1 star endorser skill
                ]
            ],
            2=>[
                'name'=>'secondLevel', //first and second category similar
                'conditions'=>[
                    5=>['name'=>'fiveStar','value'=>100,'max_value'=>300], //5 star endorser skill
                    4=>['name'=>'fourStar','value'=>80,'max_value'=>240], //4 star endorser skill
                    3=>['name'=>'threeStar','value'=>50,'max_value'=>150], //3 star endorser skill
                    2=>['name'=>'twoStar','value'=>30,'max_value'=>90], //2 star endorser skill
                    1=>['name'=>'oneStar','value'=>15,'max_value'=>45]  //1 star endorser skill
                ]
            ],
            1=>[
                'name'=>'thirdLevel', //first category similar
                'conditions'=>[
                    5=>['name'=>'fiveStar','value'=>80,'max_value'=>160], //5 star endorser skill
                    4=>['name'=>'fourStar','value'=>50,'max_value'=>100], //4 star endorser skill
                    3=>['name'=>'threeStar','value'=>30,'max_value'=>60], //3 star endorser skill
                    2=>['name'=>'twoStar','value'=>20,'max_value'=>40], //2 star endorser skill
                    1=>['name'=>'oneStar','value'=>10,'max_value'=>30]  //1 star endorser skill
                ]
            ],
            0=>[
                'name'=>'firstLevel', //none similar
                'conditions'=>[
                    5=>['name'=>'fiveStar','value'=>60,'max_value'=>120], //5 star endorser skill
                    4=>['name'=>'fourStar','value'=>40,'max_value'=>80], //4 star endorser skill
                    3=>['name'=>'threeStar','value'=>20,'max_value'=>40], //3 star endorser skill
                    2=>['name'=>'twoStar','value'=>10,'max_value'=>30], //2 star endorser skill
                    1=>['name'=>'oneStar','value'=>5,'max_value'=>20]  //1 star endorser skill
                ]
            ],
        ]
    ],
    'recommendation'=>[
        'name'=>'recommendation',
        'weight'=>70,
        'result'=>[
            5=>180,
            4=>140,
            3=>100,
            2=>40,
            1=>10
        ],
        'attributes'=>[
            5=>['name'=>'fiveStar','value'=>70,'max_value'=>200], //5 star recommendator user
            4=>['name'=>'fourStar','value'=>50,'max_value'=>100], //4 star recommendator user
            3=>['name'=>'threeStar','value'=>30,'max_value'=>70], //3 star recommendator user
            2=>['name'=>'twoStar','value'=>20,'max_value'=>40], //2 star recommendator user
            1=>['name'=>'oneStar','value'=>10,'max_value'=>20]  //1 star recommendator user
        ]
    ],
    'opinion'=>[
        'name'=>'opinion',
        'weight'=>40,
        'result'=>[
            5=>1, //professional
            3=>2, //beginner
            1=>3  //novice
        ],
        'attributes'=>[
            5=>['name'=>'fiveStar'], //5 star skill
            3=>['name'=>'threeStar'], //3 star skill
            1=>['name'=>'oneStar']  //1 star skill
        ]
    ],
    'experience'=>[
        'name'=>'experiences',
        'weight'=>50,
        'result'=>[
            5=>180,
            4=>140,
            3=>100,
            2=>50,
            1=>15
        ],
        'attributes'=>[
            'experience'=>10, //value of each experience
            'like'=>5, //value of like
            'dislike'=>2 //value of dislike
        ]
    ],
    'degree'=>[
        'name'=>'degree',
        'weight'=>60,
        'result'=>[
            5=>180,
            4=>140,
            3=>100,
            2=>70,
            1=>60
        ],
        'attributes'=>[
            'degree'=>50, //value of each degree
            'like'=>10, //value of like
            'dislike'=>4 //value of dislike
        ]
    ],
    'corporation'=>[
        'name'=>'corporation',
        'weight'=>80,
        'result'=>[
            5=>90,
            4=>70,
            3=>60,
            2=>50,
            1=>40
        ],
        'attributes'=>[
            1=>['name'=>'بهتر از انتظار','value'=>100],
            2=>['name'=>'خوب','value'=>75],
            3=>['name'=>'معمولی','value'=>50],
            4=>['name'=>'بد','value'=>25],
            5=>['name'=>'افتضاح','value'=>0]
        ]
    ],
    'job'=>[ //corporation num
        'name'=>'corporation',
        'weight'=>90,
        'result'=>[
            5=>180,
            4=>140,
            3=>100,
            2=>70,
            1=>40
        ],
        'attributes'=>[
            'corporation'=>20
        ]
    ],
    'paper'=>[
        'name'=>'paper',
        'weight'=>60,
        'result'=>[
            5=>180,
            4=>140,
            3=>100,
            2=>70,
            1=>40
        ],
        'attributes'=>[
            'book'=>[
                'book'=>150,
                'like'=>10,
                'dislike'=>4
            ],
            'article'=>[
                'article'=>40,
                'like'=>5,
                'dislike'=>2
            ]
        ]
    ],
    'history'=>[
        'name'=>'history',
        'weight'=>50,
        'result'=>[
            5=>180,
            4=>140,
            3=>100,
            2=>50,
            1=>15
        ],
        'attributes'=>[
            'history'=>40,
        ]
    ],
    'user'=>[
        'name'=>'user',
        'result'=>[
            5=>['input'=>4.8,'output'=>1],
            4=>['input'=>3.3,'output'=>0.8],
            3=>['input'=>2,'output'=>0.6],
            2=>['input'=>1,'output'=>0.4],
            1=>['input'=>0.5,'output'=>0.2]
        ]
    ],
    'profile'=>[
        'name'=>'profile',
        'weight'=>30,
        'result'=>[
            5=>90,
            4=>80,
            3=>70,
            2=>50,
            1=>30
        ],
    ]
];