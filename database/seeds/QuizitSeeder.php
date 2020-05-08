<?php

use App\Models\Quizit;
use App\Models\QuizitQuestion;
use App\Models\QuizitQuestionAnswer;
use App\User;
use Illuminate\Database\Seeder;

class QuizitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        $quizits = [
            'Lord of the Rings' =>
                [
                    'In "The Fellowship of the Ring", what is the name of the ferry the hobbits use to escape the Black Riders?' =>
                        [
                            'Bucklebury Ferry' => true,
                            'Huckleberry Ferry' => false,
                            'Huckleburry fin' => false,
                            'Bucklebury fin' => false
                        ],
                    '"You shall not pass!" Which race of creatures was soon to regret their decision not to heed this warning?' =>
                        [
                            'Nazgûl' => true,
                            'Nargûl' => false,
                            'Nazgûr' => false,
                            'Nargûz' => false
                        ],
                    'Where was the entire trilogy of the "Lord of the Rings" filmed?' =>
                        [
                            'New Zealand' => true,
                            'Iceland' => false,
                            'Greenland' => false,
                            'Norway' => false
                        ],
                    'Which of the following is NOT one of Gandalf\'s many nicknames?' =>
                        [
                            'Flame of Udun ' => true,
                            'The Grey Pilgrim ' => false,
                            'Gandalf Greyhame ' => false,
                            'Gandalf Stormcrow ' => false
                        ],
                    'How does Frodo know Sam?' =>
                        [
                            'Sam is Frodo’s gardener' => true,
                            'Sam is Frodo’s neighbour' => false,
                            'Sam and Frodo once went drinking together' => false,
                            'Sam is Frodo’s cousin' => false
                        ],
                    'In the commentary, it was noted that he passed gas in the scene where the four hobbits ran from Farmer Maggot\'s field and fell.' =>
                        [
                            'Frodo Baggins ' => true,
                            'Meriadoc Brandybuck ' => false,
                            'Samwise Gamgee ' => false,
                            'Peregrin Took' => false
                        ],
                    'I am Boromir\'s father and the Steward of Gondor.' =>
                        [
                            'Denethor' => true,
                            'Demethor ' => false,
                            'Denenthor ' => false,
                            'Denethore' => false
                        ],
                    'Legolas ...' =>
                        [
                            'Greenleaf' => true,
                            'Elven' => false,
                            'The Elf' => false,
                            'Greenish' => false
                        ],
                    'He stepped on a piece of glass, hurting his foot and delaying shooting of a scene in "The Fellowship of the Ring."' =>
                        [
                            'Samwise Gamgee' => true,
                            'Meriadoc Brandybuck' => false,
                            'Boromir, son of Denethor' => false,
                            'Aragorn, son of Arathorn' => false
                        ],
                    'I am heir to the throne of Gondor, and am known as many names!' =>
                        [
                            'Aragorn' => true,
                            'Gandalf' => false,
                            'Faramir' => false,
                            'Legolas' => false
                        ]
                ],
            'Harry Potter' =>
                [
                    'Cho Chang is in which of the following houses?' =>
                        [
                            'Ravenclaw' => true,
                            'Gryffindor' => false,
                            'Hufflepuff' => false,
                            'Slytherin' => false
                        ],
                    'In the first chapter of the book, "The Riddle House", an old muggle man named Frank unintentionally eavesdrops on Lord Voldemort and Wormtail talking. In the movie ...' =>
                        [
                            '... Barty Crouch Jr. was there too, and Voldemort was giving him an assignment.' => true,
                            '... it\'s a woman standing outside the room, and her name is Francis.' => false,
                            '... Bertha Jorkins is in the room as well.' => false,
                            '... everything happens exactly the same way.' => false
                        ],
                    'Who said: "Blimey, the old codger can see out of the back of his head!"' =>
                        [
                            'Seamus Finnigan' => true,
                            'Ron Weasley' => false,
                            'Dean Thomas' => false,
                            'Neville Longbottom' => false
                        ],
                    'In the book, the Weasleys send a letter (by muggle-mail) to Harry while he is staying with the Dursleys, inviting Harry to join their family in attending the Quidditch World Cup. In the movie ...' =>
                        [
                            '... there is no letter, and the Dursleys don\'t appear at all.' => true,
                            '... the Weasleys use one postage stamp, and know all about "muggle-mail".' => false,
                            '... they send the letter the "magical way", using owls.' => false,
                            '... everything happens exactly the same way.' => false
                        ],
                    'The Triwizard Champions\' first task is to face one of four dragons. Harry draws the Hungarian Horntail - the nastiest of the bunch. What does he summon in order to help him with this task?' =>
                        [
                            'Broomstick' => true,
                            'Dobby the elf' => false,
                            'Mimbulus mimbletonia (noise plant)' => false,
                            'Gillyweed' => false
                        ],
                    'In the book, Dumbledore calmly asks Harry if he put his name in the Goblet of Fire after picking his name out as an uncalled-for fourth student. In the movie ...' =>
                        [
                            '... Dumbledore grabs Harry and more roughly asks him the same question.' => true,
                            '... Snape picks Harry\'s name out, and asks the question in a malevolent tone.' => false,
                            '... Karkaroff harshly asks Harry the question.' => false,
                            '... no one asks Harry the question, and it is assumed that Harry did.' => false
                        ],
                    'When Harry is in the bathtub and Moaning Myrtle comes into the bathroom, how does Harry try to cover himself?' =>
                        [
                            'The bubbles from the bath' => true,
                            'The golden egg' => false,
                            'Soap bar' => false,
                            'A towel' => false
                        ],
                    'In the book, the house elf Dobby steals the gillyweed from Professor Snape and gives it to Harry (to use in the second task). In the movie ...' =>
                        [
                            '... Mad Eye Moody gives Neville the idea of having Harry use gillyweed, and Neville tells Harry about the amazing plant.' => true,
                            '... everything happens exactly the same way.' => false,
                            '... Neville steals the gillyweed and gives it to Hermione, to give to Harry.' => false,
                            '... Harry steals it himself after Dobby informs him that he must use gillyweed.' => false
                        ],
                    'Who gave Harry advanced warning about what the first task in the Tournament would be?' =>
                        [
                            'Hagrid' => true,
                            'Ron Weasly' => false,
                            'Hermione' => false,
                            'Cho Chang' => false
                        ],
                    'One day, while walking down the hallway, you hear Ron Weasley sort of scream something at Fleur Delacour. Everyone looks a bit frightened and shocked, and you then realize that he tried to ask her out. Ron must have also just realized what he has actually done because without notice Ron ...' =>
                        [
                            'Runs for it' => true,
                            'Passes out ' => false,
                            'Wets himself ' => false,
                            'Apologizes' => false
                        ]
                ],
            'Star Wars' =>
                [
                    'Which of the following people was NOT credited as one of the scriptwriters for "Episode VII - The Force Awakens"?' =>
                        [
                            'George Lucas' => true,
                            'Lawrence Kasdan ' => false,
                            'J. J. Abrams ' => false,
                            'Michael Arndt ' => false
                        ],
                    '"I have a bad feeling about this." Who delivers his feelings about the ongoing situation on Naboo?' =>
                        [
                            'Obi-Wan Kenobi' => true,
                            'Leia' => false,
                            'Luke Skywalker' => false,
                            'Yoda' => false
                        ],
                    'Who was Kylo Ren\'s father?' =>
                        [
                            'Han solo' => true,
                            'Darth Vader' => false,
                            'Luke Skywalker' => false,
                            'Rey' => false
                        ],
                    'Finn is a new character introduced in this film. Which of the following statements is true about him?' =>
                        [
                            'He was a Stormtrooper.' => true,
                            'He was a moisture farmer on a waterworld. ' => false,
                            'He was a rival smuggler to Solo and the son of Luke Skywalker. ' => false,
                            'He was a clone of Luke Skywalker and a dark side of the force user.' => false
                        ],
                    'Which of the following characters did NOT appear in the movies?' =>
                        [
                            'Ask Aak' => true,
                            'Luminara Unduli' => false,
                            'Onaconda Farr' => false,
                            'Kit Fisto' => false
                        ],
                    'Who had the control over the first deathstar' =>
                        [
                            'Tarkin' => true,
                            'Darth Vader' => false,
                            'Boba fett' => false,
                            'Mace windu' => false
                        ],
                    'The Newsreel was a montage of clips showing a series of events going on. Which of the following clips was NOT shown in the Newsreel?' =>
                        [
                            'The Battle of Geonosis' => true,
                            'Space Battle over Christophsis' => false,
                            'The Clone Army' => false,
                            'Jabba\'s Sail Barge attacked' => false
                        ],
                    'Who said: \'I have a bad feeling about this.\'' =>
                        [
                            'All of the these' => true,
                            'Luke Skywalker ' => false,
                            'Han Solo ' => false,
                            'Obi Wan Kenobi' => false
                        ],
                    'Which of the following did Yoda NOT say?' =>
                        [
                            '“Trust your feelings you will soon learn.”' => true,
                            '"Fought well you have, my old padawan."' => false,
                            '"Young Skywalker is in terrible pain."' => false,
                            '"Qui-Gon\'s defiance I sense in you."' => false
                        ],
                    'Who said: "Look at the size of that thing."' =>
                        [
                            'Wedge' => true,
                            'Luke' => false,
                            'Biggs' => false,
                            'that’s what she said' => false
                        ]
                ],
            'The Matrix' =>
                [
                    'Which character was a previous incarnation of the One? ' =>
                        [
                            'The Merovingian' => true,
                            'The Architect' => false,
                            'The Keymaker' => false,
                            'Seraph' => false
                        ],
                    'Which religion is referenced in The Matrix trilogy?' =>
                        [
                            'All of the above' => true,
                            'Buddhism' => false,
                            'Gnosticism' => false,
                            'Christianity' => false
                        ],
                    'How does the Nebuchadnezzar initially contact Neo?' =>
                        [
                            'Through his home computer' => true,
                            'Through the white rabbit' => false,
                            'Through a cell phone at work' => false,
                            'Through an analog phone booth' => false
                        ],
                    'How does Trinity resurrect Neo, when he dies in The Matrix?' =>
                        [
                            'She kisses him' => true,
                            'She enters the Matrix and defeats Agent Smith' => false,
                            'She gives Neo CPR on the Nebuchadnezzar' => false,
                            'She asks Morpheus for help' => false
                        ],
                    'How does Neo resurrect Trinity, when she dies in The Matrix Reloaded?' =>
                        [
                            'He reaches into her body and massages her heart' => true,
                            'He removes the bullet from her body' => false,
                            'He patches her into the Agents’ network' => false,
                            'Trinity doesn’t really die' => false
                        ],
                    'Which crew member’s body does Agent Smith infiltrate?' =>
                        [
                            'Bane’s' => true,
                            'Tank’s' => false,
                            'Link’s' => false,
                            'Cypher’s' => false
                        ],
                    'Who makes a deal with Agent Smith to sell out Morpheus in The Matrix?' =>
                        [
                            'Cypher' => true,
                            'Agent Brown' => false,
                            'Mouse' => false,
                            'The Oracle' => false
                        ],
                    'How do freed minds leave the Matrix and return to the real world?' =>
                        [
                            'Via phone booths' => true,
                            'Via cell phones' => false,
                            'Via subways' => false,
                            'Via modems' => false
                        ],
                    'About what year is it in the ravaged real world?' =>
                        [
                            '2199' => true,
                            '1999' => false,
                            '2060' => false,
                            '5416' => false
                        ],
                    'What happens after Neo is resurrected in The Matrix?' =>
                        [
                            'He can see the code of the Matrix’s program' => true,
                            'Zion is saved from the sentinels' => false,
                            'He becomes expert in Jujitsu' => false,
                            'Trinity declares her love for him' => false
                        ]

                ]
        ];

        foreach ($users as $user) {
            foreach ($quizits as $name => $questions) {
                $quizit = new Quizit();
                $quizit->name = $name;
                $quizit->author_id = $user->id;
                $quizit->save();

                foreach ($questions as $question => $answers) {
                    $quizitQuestion = new QuizitQuestion();
                    $quizitQuestion->quizit_id = $quizit->id;
                    $quizitQuestion->question = $question;
                    $quizitQuestion->save();

                    foreach ($answers as $answer => $correct) {
                        $quizitQuestionAnswer = new QuizitQuestionAnswer();
                        $quizitQuestionAnswer->question_id = $quizitQuestion->id;
                        $quizitQuestionAnswer->answer = $answer;
                        $quizitQuestionAnswer->correct = $correct;
                        $quizitQuestionAnswer->save();
                    }
                }
            }
        }
    }
}
