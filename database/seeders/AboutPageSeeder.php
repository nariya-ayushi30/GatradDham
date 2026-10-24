<?php

namespace Database\Seeders;

use App\Models\AboutPage;
use Illuminate\Database\Seeder;

class AboutPageSeeder extends Seeder
{
    public function run(): void
    {
        AboutPage::updateOrCreate(['id' => 1], [
            'banner_badge_gu' => 'પાવન તીર્થધામ પરિચય',
            'banner_badge_en' => 'Sacred Pilgrimage Heritage',
            'banner_title_gu' => 'શ્રી ગાત્રાળ માતાજીનો દિવ્ય મહિમા & પાવન ઇતિહાસ',
            'banner_title_en' => 'Divine Glory & History of Shree Gatrad Mataji',
            'banner_subtitle_gu' => 'શ્રદ્ધા, ભક્તિ, સેવા અને સંસ્કારનું પવિત્ર સંગમ સ્થળ — શ્રી ગાત્રાળ ધામ દેવગામની પાવન ઉત્પત્તિ, ચમત્કારો અને લોકસેવા.',
            'banner_subtitle_en' => 'A sacred confluence of faith, devotion, and selfless service — the divine origin, spiritual miracles, and humanitarian mission of Shree Gatrad Dham Devgam.',
            'hero_image' => '/uploads/sliders/banner_1.jpg',

            'sec1_title_gu' => '૧. શ્રી ગાત્રાળ માતાજીનો પ્રાદુર્ભાવ & દિવ્ય મહિમા',
            'sec1_title_en' => '1. Divine Glory & Origin of Shree Gatrad Maa',
            'sec1_content_gu' => "શ્રી ગાત્રાળ માં સમગ્ર સૌરાષ્ટ્ર, ગુજરાત તેમજ દેશ-વિદેશમાં વસતા લાખો ભક્તોની પરમ આરાધ્ય કુળદેવી તરીકે પૂજાય છે. વાળા પરિવાર, દાફડા પરિવાર, ચાવડા તેમજ અન્ય અનેક શ્રદ્ધાળુ પરિવારો માતાજીને પોતાની રક્ષક કુળદેવી માને છે.\n\n'ગાત્રાળ' નામનો ગૂઢ અર્થ થાય છે: ભક્તોના પ્રત્યેક અંગ, ગાત્ર ('ગાત્રાળ') અને પ્રાણની સર્વ વિઘ્નો સામે રક્ષા કરનારી દયાળુ જગદંબા. પ્રાચીન પરંપરા અનુસાર માં ગાત્રાળ ભક્તો પર અસીમ વાત્સલ્ય વરસાવે છે અને આસુરી વૃત્તિઓ તથા અંધકારનો નાશ કરે છે. શુદ્ધ હૃદયથી માંની સ્તુતિ કરવાથી તમામ દુઃખ, સંકટ અને વ્યાધિઓ દૂર થાય છે.",
            'sec1_content_en' => "Shree Gatrad Maa is venerated as the supreme Kuldevi (family guardian deity) of millions of devotees across Saurashtra, Gujarat, and around the world. Families including the Vala, Dafda, Chavda, and many other communities hold profound faith in Her maternal protection.\n\nThe holy name 'Gatrad' derives from 'Gatra' (the body and vital limbs), signifying the divine Mother who fiercely shields every devotee's life and limb from harm, obstacles, and negativities. Steeped in centuries of Saurashtra folklore and saintly traditions, Maa Gatrad blesses sincere seekers with spiritual courage, lasting peace, good health, and family prosperity.",
            'sec1_image' => '/uploads/sliders/banner_2.jpg',

            'shlok_text' => "ગાત્રે ગાત્રે સ્થિતા યા સા, સર્વ સંકટ નાશિની ।\nનમસ્તસ્યૈ નમસ્તસ્યૈ, ગાત્રાળ્યૈ સતતં નમઃ ॥",
            'shlok_meaning_gu' => 'અર્થ: જે સમસ્ત પ્રાણીઓના પ્રત્યેક અંગ-ગાત્રમાં વ્યાપીને તમામ સંકટોનું નિવારણ કરે છે, તે સર્વકલ્યાણકારી શ્રી ગાત્રાળ દેવીને અમારા વારંવાર પ્રણામ હો.',
            'shlok_meaning_en' => 'Meaning: "Salutations to the Supreme Goddess Gatrali, who abides in every vital limb of all beings as their celestial protector, the granter of righteous boons, and the eternal dispeller of all adversities."',
            'shlok_badge_gu' => '— શ્રી ગાત્રાળ પાવન સ્તુતિ મંત્ર',
            'shlok_badge_en' => '— Sacred Gatrad Stuti Hymn',

            'sec2_title_gu' => '૨. પાવન તીર્થધામનો વિકાસ & ટ્રસ્ટ પ્રકલ્પો',
            'sec2_title_en' => '2. Development of the Holy Pilgrimage Center & Trust',
            'sec2_content_gu' => "પ્રારંભમાં દેવગામ મુકામે આ સ્થાનક પર એક નાની દેરીમાં માતાજીની પૂજા-અર્ચના થતી હતી. સમય જતાં ભક્તોની અતૂટ શ્રદ્ધા, ત્યાગ અને ઉદાર દાનથી આજે અહીં ભવ્ય અને દિવ્ય મંદિર સંકુલનું નિર્માણ થયું છે.\n\nશ્રી ગાત્રાળ ધામ ચેરીટેબલ ટ્રસ્ટ દ્વારા અહીં આવતા તમામ યાત્રાળુઓ માટે નિઃશુલ્ક મહાપ્રસાદ અન્નક્ષેત્ર, આધુનિક સુવિધાયુક્ત યાત્રિક ભવન (ધર્મશાળા), ગૌશાળા અને મેડિકલ સેવાઓ સુચારુ રૂપે ચલાવવામાં આવે છે. મંદિરમાં બિરાજમાન માં ગાત્રાળની તેજોમય મૂર્તિના દર્શન માત્રથી જ ભક્તોનું મન પરમ શાંતિ અને આધ્યાત્મિક ઊર્જાથી ભરાઈ જાય છે.",
            'sec2_content_en' => "Initially, daily worship was offered at a modest village shrine in Devgam. Over generations, nurtured by the deep devotion, selflessness, and generous contributions of pilgrims, the sacred site has blossomed into a magnificent pilgrimage complex.\n\nThe Shree Gatrad Mataji Mandir Charitable Trust now oversees an array of humanitarian and spiritual missions: the continuous Sadavrat Annakshetra providing wholesome satvik meals, the serene Yatrik Bhavan dharamshala for visiting families, a dedicated Gaushala caring for Gir cows, and free medical diagnostic camps for nearby villages.",
            'sec2_image' => '/uploads/sliders/banner_3.jpg',

            'feature1_icon' => 'fa-shield-halved',
            'feature1_title_gu' => 'અભય વરદાન & રક્ષણ',
            'feature1_title_en' => 'Divine Protection & Grace',
            'feature1_desc_gu' => 'માં ગાત્રાળ શરણાગત ભક્તોના તમામ કષ્ટો, ચિંતા અને વિઘ્નોનું નિવારણ કરે છે.',
            'feature1_desc_en' => 'Maa Gatrad blesses seekers with courage, good health, and peace of mind.',

            'feature2_icon' => 'fa-fire-flame-curved',
            'feature2_title_gu' => 'અખંડ જ્યોત & શૃંગાર',
            'feature2_title_en' => 'Eternal Flame & Shringar',
            'feature2_desc_gu' => 'વર્ષોથી પ્રજ્વલિત પાવન અખંડ જ્યોત અને નિત્ય મનોહર સુવર્ણ શૃંગાર દર્શન.',
            'feature2_desc_en' => 'Sacred eternal akhand jyot burning continuously with daily divine shringar.',

            'feature3_icon' => 'fa-bowl-food',
            'feature3_title_gu' => 'અવિરત અન્નક્ષેત્ર સેવા',
            'feature3_title_en' => 'Free Mahaprasad Seva',
            'feature3_desc_gu' => 'દરરોજ હજારો યાત્રાળુઓ માટે શુદ્ધ અને સાત્વિક ભોજન પ્રસાદની નિઃશુલ્ક વ્યવસ્થા.',
            'feature3_desc_en' => 'Wholesome vegetarian satvik meals served freely to all visiting pilgrims.',

            'feature4_icon' => 'fa-heart-pulse',
            'feature4_title_gu' => 'ગૌશાળા & લોકસેવા',
            'feature4_title_en' => 'Gaushala & Humanitarian Aid',
            'feature4_desc_gu' => 'ગીર ગાયોનું સ્નેહપૂર્ણ જતન, વિનામૂલ્યે મેડિકલ કેમ્પ અને જનસેવાના પ્રકલ્પો.',
            'feature4_desc_en' => 'Protection of sacred cows, free medical camps, and community support.',

            'stat1_val' => '100+',
            'stat1_label_gu' => 'વર્ષોની અખંડ આસ્થા',
            'stat1_label_en' => 'Years of Faith',
            'stat2_val' => '5,000+',
            'stat2_label_gu' => 'દૈનિક દર્શનાર્થીઓ',
            'stat2_label_en' => 'Daily Devotees',
            'stat3_val' => '365',
            'stat3_label_gu' => 'દિવસ અન્નક્ષેત્ર સેવા',
            'stat3_label_en' => 'Days Mahaprasad',
            'stat4_val' => '100%',
            'stat4_label_gu' => 'સેવાભાવી ચેરીટેબલ ટ્રસ્ટ',
            'stat4_label_en' => 'Charitable Trust',
        ]);
    }
}
