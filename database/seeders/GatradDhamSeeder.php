<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AartiTiming;
use App\Models\TrustActivity;
use App\Models\CommitteeMember;
use App\Models\GalleryItem;
use App\Models\BlogPost;
use App\Models\LiveDarshan;
use App\Models\Donation;
use App\Models\RoomBooking;
use App\Models\ContactInquiry;
use App\Models\Slider;

class GatradDhamSeeder extends Seeder
{
    /**
     * Seed the Gatrad Dham database with authentic, high-quality bilingual data.
     */
    public function run(): void
    {
        // ==========================================
        // 1. AARTI TIMINGS (5 Daily Aartis)
        // ==========================================
        AartiTiming::truncate();
        $aartis = [
            [
                'title_en' => 'Mangla Aarti (Dawn)',
                'title_gu' => 'મંગળા આરતી (પ્રભાત)',
                'time_en' => '5:30 AM',
                'time_gu' => 'સવારે ૫:૩૦ કલાકે',
                'desc_en' => 'The auspicious dawn aarti welcoming the divine presence, blessing devotees with spiritual peace and purity for the day ahead.',
                'desc_gu' => 'દિવસના પ્રારંભે માતાજીના પાવન મંગળા દર્શન અને આરતી, જે ભક્તોના જીવનમાં સુખ, શાંતિ અને નવી ઊર્જાનો સંચાર કરે છે.',
                'badge_en' => 'Morning Dawn',
                'badge_gu' => 'પ્રભાત દર્શન',
                'order' => 1
            ],
            [
                'title_en' => 'Shringar Darshan Aarti',
                'title_gu' => 'શૃંગાર દર્શન આરતી',
                'time_en' => '8:15 AM',
                'time_gu' => 'સવારે ૮:૧૫ કલાકે',
                'desc_en' => 'Divine darshan with fresh fragrant flowers, golden crown, silk vastra, and sacred Vedic stutis.',
                'desc_gu' => 'તાજા સુગંધિત પુષ્પો, સુવર્ણ મુગટ અને રેશમી વસ્ત્રોના અલૌકિક શૃંગાર સાથે થતી દિવ્ય આરતી.',
                'badge_en' => 'Adornment',
                'badge_gu' => 'સુવર્ણ શૃંગાર',
                'order' => 2
            ],
            [
                'title_en' => 'Rajbhog Thal & Maha Aarti',
                'title_gu' => 'રાજભોગ થાળ & મહાઆરતી',
                'time_en' => '12:00 PM',
                'time_gu' => 'બપોરે ૧૨:૦૦ કલાકે',
                'desc_en' => 'Offering of holy satvik prasad thal to Maa Gatrad followed by the grand noon maha aarti attended by pilgrims.',
                'desc_gu' => 'માતાજીને પવિત્ર સાત્વિક ભોગ-થાળ અર્પણ કર્યા બાદ યોજાતી ભવ્ય મધ્યાહ્ન મહાઆરતી.',
                'badge_en' => 'Noon Feast',
                'badge_gu' => 'રાજભોગ દર્શન',
                'order' => 3
            ],
            [
                'title_en' => 'Sandhya Deepmala Aarti',
                'title_gu' => 'સંધ્યા દીપમાળા આરતી',
                'time_en' => '7:00 PM',
                'time_gu' => 'સાંજે ૭:૦૦ કલાકે',
                'desc_en' => 'Evening twilight aarti accompanied by hundreds of brass oil lamps, resonant temple bells, and sacred chanting.',
                'desc_gu' => 'ઝળહળતા પિત્તળના દીવડાઓ, ઝાલર અને નગારાના મંગલ નાદ વચ્ચે યોજાતી ભવ્ય સંધ્યા આરતી.',
                'badge_en' => 'Evening Twilight',
                'badge_gu' => 'દીપમાળા',
                'order' => 4
            ],
            [
                'title_en' => 'Shayan Aarti (Night)',
                'title_gu' => 'શયન આરતી (રાત્રિ)',
                'time_en' => '9:00 PM',
                'time_gu' => 'રાત્રે ૯:૦૦ કલાકે',
                'desc_en' => 'The peaceful night closing aarti seeking the divine mother\'s blessings before the inner sanctum rests.',
                'desc_gu' => 'દિવસની અંતિમ શાંતિપૂર્ણ આરતી અને માતાજીના ચરણોમાં કૃપા-પ્રાર્થના.',
                'badge_en' => 'Night Rest',
                'badge_gu' => 'વિશ્રામ આરતી',
                'order' => 5
            ],
        ];
        foreach ($aartis as $a) {
            AartiTiming::create($a);
        }

        // ==========================================
        // 2. TRUST ACTIVITIES (4 Comprehensive Seva Activities)
        // ==========================================
        TrustActivity::truncate();
        $activities = [
            [
                'title_en' => 'Sadavrat Mahaprasad Annakshetra',
                'title_gu' => 'સદાવ્રત અન્નક્ષેત્ર મહાપ્રસાદ સેવા',
                'subtitle_en' => 'Free hygienic satvik meals served daily to all pilgrims and visitors without discrimination.',
                'subtitle_gu' => 'મંદિરે પધારતા તમામ ભાવિક ભક્તો અને સાધુ-સંતો માટે અવિરત નિઃશુલ્ક શુદ્ધ ભોજન પ્રસાદ.',
                'description_en' => 'Under the divine grace of Shree Gatrad Mataji, our continuous Annakshetra serves hot, hygienic, freshly prepared Gujarati satvik meals (roti, dal, bhat, shaak, and sweets on festival days) every single day. Over 1,500 devotees take prasad daily, reaching over 5,000 on Poonam and festival occasions.',
                'description_gu' => 'શ્રી ગાત્રાળ ધામ ટ્રસ્ટ દ્વારા સંચાલિત સદાવ્રત અન્નક્ષેત્રમાં દરરોજ ૧૫૦૦ થી વધુ ભાવિકો પ્રેમપૂર્વક સાત્વિક ભોજન પ્રસાદ ગ્રહણ કરે છે. પૂનમ અને તહેવારોના દિવસોમાં હજારો ભક્તો માટે વિશેષ મિષ્ટાન સાથે મહાપ્રસાદનું આયોજન થાય છે.',
                'icon' => 'fa-bowl-rice',
                'stats_en' => '1,500+ Daily Meals',
                'stats_gu' => '૧,૫૦૦+ દૈનિક ભોજન',
                'image_url' => '/uploads/activities/activity_annakshetra.jpg'
            ],
            [
                'title_en' => 'Shree Gatrad Gaushala & Gir Cow Conservation',
                'title_gu' => 'શ્રી ગાત્રાળ ગૌશાળા & ગીર ગાય સંવર્ધન',
                'subtitle_en' => 'Dedicated sanctuary caring for over 250 indigenous Gir cows with nutritious green fodder and medical veterinary care.',
                'subtitle_gu' => '૨૫૦+ દેશી ગીર ગાયોનું સ્નેહપૂર્ણ લાલન-પાલન, લીલો ઘાસચારો અને નિઃશુલ્ક પશુ ચિકિત્સા સેવા.',
                'description_en' => 'Gau Seva is central to the heritage of Maa Gatrad. Our sprawling Gaushala provides natural open sheds, clean drinking water, fresh organic green fodder, and dedicated veterinary healthcare. Devotees regularly participate in Gau-Gras donation, Tulabhar, and calf adoption seva.',
                'description_gu' => 'માં ગાત્રાળની પરમ કૃપાથી સંચાલિત ગૌશાળામાં ગીર ગૌવંશનું જતન કરવામાં આવે છે. ભક્તો ગૌ-ગ્રાસ, ઘાસચારા દાન અને તુલાભાર સેવા દ્વારા ગૌમાતાના આશીર્વાદ પ્રાપ્ત કરે છે.',
                'icon' => 'fa-cow',
                'stats_en' => '250+ Sacred Gir Cows',
                'stats_gu' => '૨૫૦+ પવિત્ર ગીર ગાયો',
                'image_url' => '/uploads/activities/activity_gaushala.jpg'
            ],
            [
                'title_en' => 'Yatrik Bhavan & Pilgrims Dharamshala',
                'title_gu' => 'યાત્રિક ભવન & યાત્રાળુ ધર્મશાળા',
                'subtitle_en' => 'Clean, serene, affordable AC and Non-AC accommodations for visiting families and long-distance devotees.',
                'subtitle_gu' => 'દૂર-સુદૂરથી દર્શનાર્થે આવતા પરિવારો માટે સ્વચ્છ, શાંત અને આધુનિક સુવિધાયુક્ત રૂમની વ્યવસ્થા.',
                'description_en' => 'To facilitate peaceful stays for pilgrims traveling from across Gujarat and India, the trust operates modern Yatrik Bhavan guest rooms equipped with attached clean bathrooms, round-the-clock water, lift access, security, and peaceful temple courtyards.',
                'description_gu' => 'મંદિર પરિસરમાં શાંત અને સુરક્ષિત વાતાવરણ વચ્ચે AC તેમજ Non-AC રૂમો ઉપલબ્ધ છે, જ્યાં ભક્તો પોતાના પરિવાર સાથે સગવડતાપૂર્વક રોકાણ કરી શકે છે.',
                'icon' => 'fa-hotel',
                'stats_en' => '60+ Guest Rooms',
                'stats_gu' => '૬૦+ અતિથિ કક્ષ',
                'image_url' => '/uploads/activities/activity_dharamshala.jpg'
            ],
            [
                'title_en' => 'Free Community Medical Aid & Health Camps',
                'title_gu' => 'નિઃશુલ્ક મેડિકલ સહાય & આરોગ્ય કેમ્પ',
                'subtitle_en' => 'Regular free eye checkups, blood donation drives, and medical consultations for surrounding rural villages.',
                'subtitle_gu' => 'આસપાસના ગ્રામ્ય વિસ્તારના જરૂરિયાતમંદ લોકો માટે વિનામૂલ્યે આરોગ્ય તપાસ અને દવા વિતરણ.',
                'description_en' => 'In addition to religious seva, the Trust actively promotes community healthcare. Monthly medical diagnosis camps, free eye testing and cataract surgeries, and emergency ambulance assistance are provided to the rural population around Devgam and Amreli district.',
                'description_gu' => 'ટ્રસ્ટ દ્વારા દર મહિને વિનામૂલ્યે નેત્ર નિદાન કેમ્પ, સામાન્ય રોગ તપાસ અને દવા વિતરણ દ્વારા ગ્રામીણ જનતાની આરોગ્ય સુખાકારી માટે માનવસેવા પ્રવૃત્તિઓ ચલાવવામાં આવે છે.',
                'icon' => 'fa-heart-pulse',
                'stats_en' => '10,000+ Patients Helped',
                'stats_gu' => '૧૦,૦૦૦+ દર્દીઓને સહાય',
                'image_url' => '/uploads/activities/activity_medical.jpg'
            ],
        ];
        foreach ($activities as $act) {
            TrustActivity::create($act);
        }

        // ==========================================
        // 3. COMMITTEE MEMBERS (Trust & Gam Members)
        // ==========================================
        CommitteeMember::truncate();
        $members = [
            // Trust Committee
            [
                'name_en' => 'Shri Rajeshbhai M. Patel',
                'name_gu' => 'શ્રી રાજેશભાઈ એમ. પટેલ',
                'designation_en' => 'Managing Trustee & President',
                'designation_gu' => 'મેનેજિંગ ટ્રસ્ટી & પ્રમુખ',
                'committee_type' => 'trust',
                'village_en' => 'Devgam / Rajkot',
                'village_gu' => 'દેવગામ / રાજકોટ',
                'phone' => '+91 98250 14521',
                'photo_url' => null,
                'order' => 1
            ],
            [
                'name_en' => 'Shri Mansukhbhai H. Vala',
                'name_gu' => 'શ્રી મનસુખભાઈ એચ. વાળા',
                'designation_en' => 'Vice President',
                'designation_gu' => 'ઉપપ્રમુખ',
                'committee_type' => 'trust',
                'village_en' => 'Devgam',
                'village_gu' => 'દેવગામ',
                'phone' => '+91 98981 76234',
                'photo_url' => null,
                'order' => 2
            ],
            [
                'name_en' => 'Shri Hiteshbhai K. Dafda',
                'name_gu' => 'શ્રી હિતેશભાઈ કે. દાફડા',
                'designation_en' => 'General Secretary',
                'designation_gu' => 'મહામંત્રી',
                'committee_type' => 'trust',
                'village_en' => 'Surat / Devgam',
                'village_gu' => 'સુરત / દેવગામ',
                'phone' => '+91 94262 88910',
                'photo_url' => null,
                'order' => 3
            ],
            [
                'name_en' => 'Shri Bharatbhai D. Vala',
                'name_gu' => 'શ્રી ભરતભાઈ ડી. વાળા',
                'designation_en' => 'Treasurer & Accounts Head',
                'designation_gu' => 'ખજાનચી (ટ્રેઝરર)',
                'committee_type' => 'trust',
                'village_en' => 'Amreli',
                'village_gu' => 'અમરેલી',
                'phone' => '+91 98240 33412',
                'photo_url' => null,
                'order' => 4
            ],

            // Gam Committee
            [
                'name_en' => 'Shri Dahyabhai P. Chavda',
                'name_gu' => 'શ્રી ડાહ્યાભાઈ પી. ચાવડા',
                'designation_en' => 'Gam Committee President & Sarpanch',
                'designation_gu' => 'ગામ કમિટી પ્રમુખ & સરપંચ',
                'committee_type' => 'gam',
                'village_en' => 'Devgam',
                'village_gu' => 'દેવગામ',
                'phone' => '+91 99092 45123',
                'photo_url' => null,
                'order' => 1
            ],
            [
                'name_en' => 'Shri Kanjibhai R. Vala',
                'name_gu' => 'શ્રી કાનજીભાઈ આર. વાળા',
                'designation_en' => 'Youth & Utsav Coordinator',
                'designation_gu' => 'યુવા મંડળ & ઉત્સવ સંયોજક',
                'committee_type' => 'gam',
                'village_en' => 'Devgam',
                'village_gu' => 'દેવગામ',
                'phone' => '+91 97230 67890',
                'photo_url' => null,
                'order' => 2
            ],
            [
                'name_en' => 'Shri Praveenbhai S. Rathod',
                'name_gu' => 'શ્રી પ્રવીણભાઈ એસ. રાઠોડ',
                'designation_en' => 'Volunteer Seva In-Charge',
                'designation_gu' => 'સ્વયંસેવક સેવા પ્રમુખ',
                'committee_type' => 'gam',
                'village_en' => 'Devgam',
                'village_gu' => 'દેવગામ',
                'phone' => '+91 98795 12044',
                'photo_url' => null,
                'order' => 3
            ],
        ];
        foreach ($members as $m) {
            CommitteeMember::create($m);
        }

        // ==========================================
        // 4. BLOG POSTS (3 Authentic Temple Updates)
        // ==========================================
        BlogPost::truncate();
        $blogs = [
            [
                'title_en' => 'Grand Navratri Mahotsav & Raas-Garba Celebrations at Shree Gatrad Dham',
                'title_gu' => 'શ્રી ગાત્રાળ ધામ ખાતે ભવ્ય નવરાત્રિ મહોત્સવ અને રાસ-ગરબાનું આયોજન',
                'slug' => 'grand-navratri-mahotsav-celebration',
                'excerpt_en' => 'Devotees from across Saurashtra gathered for nine holy nights of traditional Garba, special midnight Maha Aartis, and round-the-clock Annakshetra prasad.',
                'excerpt_gu' => 'નવરાત્રિ પર્વ નિમિત્તે નવ દિવસ અવિરત માતાજીના ભક્તિભાવપૂર્વક ગરબા, મધ્યરાત્રિની મહાઆરતી અને અન્નક્ષેત્ર મહાપ્રસાદનું આયોજન કરવામાં આવ્યું છે.',
                'content_en' => 'The auspicious festival of Navratri is being celebrated with utmost devotional fervor at Shree Gatrad Dham Devgam. Special lighting arrangements, divine flower decorations for Maa Gatradji\'s golden mukharvind, and traditional heritage raas-garba competitions are underway. The trust committee has made comprehensive arrangements for pure drinking water, parking facilities, medical assistance, and accommodation for thousands of traveling pilgrims.',
                'content_gu' => 'શ્રી ગાત્રાળ ધામ દેવગામ મુકામે આસો સુદ એકમથી નોમ સુધી ભવ્ય નવરાત્રિ મહોત્સવની હર્ષોલ્લાસપૂર્વક ઉજવણી થઈ રહી છે. ભક્તોના ભારે ધસારાને પહોંચી વળવા માટે ટ્રસ્ટ મંડળ દ્વારા સુરક્ષા, સાત્વિક ભોજન અને રહેવાની ઉત્તમ સગવડ પૂરી પાડવામાં આવી છે.',
                'image_url' => '/uploads/blogs/blog_navratri.jpg',
                'published_date' => now()->subDays(2)
            ],
            [
                'title_en' => 'Annual Temple Patotsav & 51-Kundi Sacred Yajna Ceremony Invitation',
                'title_gu' => 'વાર્ષિક પાટોત્સવ & ૫૧ કુંડી મહાયજ્ઞ મહોત્સવનું પાવન નિમંત્રણ',
                'slug' => 'annual-temple-patotsav-51-kundi-yajna',
                'excerpt_en' => 'Cordially inviting all devotee families to participate in the upcoming Annual Patotsav, golden flag hoisting (Dhwajavahan), and Vedic Maha Yajna.',
                'excerpt_gu' => 'મંદિર પ્રાણપ્રતિષ્ઠા દિન નિમિત્તે ૫૧ કુંડી પાવન મહાયજ્ઞ, ધ્વજારોહણ અને સંત સંમેલનનું આયોજન કરવામાં આવ્યું છે.',
                'content_en' => 'On the holy occasion of the Temple\'s Foundation Day (Patotsav), a grand 51-Kundi Vedic Maha Yajna will be conducted by learned Vedic scholars. Devotees are invited to offer Ahuti for family peace and prosperity. The ceremony will feature sacred Dhwaja (flag) hoisting on the temple shikhar, Bhajan Santvani at night, and Maha Prasad distribution for over 10,000 pilgrims.',
                'content_gu' => 'શ્રી ગાત્રાળ ધામ ખાતે વાર્ષિક પાટોત્સવનું ભવ્ય આયોજન કરવામાં આવ્યું છે. શાસ્ત્રોક્ત વિધિ-વિધાન સાથે યજ્ઞશાળામાં ૫૧ કુંડી હવન યોજાશે અને શિખર પર નૂતન ધ્વજારોહણ થશે. સર્વે ભાવિકોને પધારવા ભાવભર્યું આમંત્રણ છે.',
                'image_url' => '/uploads/blogs/blog_patotsav.jpg',
                'published_date' => now()->subDays(6)
            ],
            [
                'title_en' => 'New Gaushala Shed & Modern AC Rooms Inauguration at Yatrik Bhavan',
                'title_gu' => 'નવીન ગૌશાળા શેડ અને યાત્રિક ભવન આધુનિક કક્ષોનું શુભ લોકાર્પણ',
                'slug' => 'gaushala-shed-yatrik-bhavan-expansion',
                'excerpt_en' => 'Thanks to generous donor contributions, a state-of-the-art cow shed for 100 more Gir cows and 20 new AC guest rooms have been opened for devotees.',
                'excerpt_gu' => 'દાતાશ્રીઓના સહયોગથી ગૌશાળામાં વધુ ૧૦૦ ગીર ગાયો માટે અદ્યતન શેડ અને યાત્રાળુઓ માટે ૨૦ નવા સુવિધાસભર AC રૂમો તૈયાર કરવામાં આવ્યા છે.',
                'content_en' => 'The managing trust has successfully completed phase-2 expansion of Shree Gatrad Dham campus. The new Gaushala wing features automated water fountains, organic fodder processing, and spacious shade for cows. Simultaneously, the newly built wing of Yatrik Bhavan now offers 20 premium AC rooms with modern amenities, ensuring a restful pilgrimage experience.',
                'content_gu' => 'મંદિરમાં આવતા યાત્રિકોની સુવિધા વધારવા માટે યાત્રિક ભવનમાં નવા રૂમોનું લોકાર્પણ સંપન્ન થયું છે. આ સાથે ગૌમાતાની સેવા માટે વધુ એક વિશાળ શેડ બનાવવામાં આવ્યો છે જેથી દેશી ગૌવંશનું ઉત્તમ જતન થઈ શકે.',
                'image_url' => '/uploads/blogs/blog_gaushala_expansion.jpg',
                'published_date' => now()->subDays(12)
            ],
        ];
        foreach ($blogs as $b) {
            BlogPost::create($b);
        }

        // ==========================================
        // 5. LIVE DARSHAN DETAILS
        // ==========================================
        LiveDarshan::truncate();
        LiveDarshan::create([
            'title_en' => 'Shree Gatrad Dham Devgam - Daily Live Streaming & Darshan',
            'title_gu' => 'શ્રી ગાત્રાળ ધામ દેવગામ - દૈનિક લાઈવ દર્શન & આરતી',
            'youtube_embed_id' => 'dQw4w9WgXcQ',
            'is_live' => true,
            'today_shringar_image' => '/uploads/gallery/shringar/shringar_maa_gatrad_gold.jpeg',
            'notice_en' => 'Today\'s Morning Mangla and Shringar Darshan is active. Temple premises remain open for pilgrims from 5:00 AM to 9:30 PM daily. Evening Sandhya Aarti will be broadcast live at 7:00 PM.',
            'notice_gu' => 'આજનું પવિત્ર મંગળા અને શૃંગાર દર્શન સંપન્ન થયેલ છે. મંદિર પરિસર સવારે ૫:૦૦ થી રાત્રે ૯:૩૦ સુધી દર્શનાર્થે ખુલ્લું રહેશે. સાંજે ૭:૦૦ કલાકે સંધ્યા દીપમાળા આરતીનું લાઈવ પ્રસારણ થશે.'
        ]);

        // ==========================================
        // 6. DONATIONS (4 Authentic Verified Records)
        // ==========================================
        Donation::truncate();
        Donation::create([
            'receipt_no' => 'GD-2026-1001',
            'donor_name' => 'Rameshbhai J. Patel & Family',
            'phone' => '+91 98250 88712',
            'pan' => 'ABCDE1234F',
            'amount' => 21000.00,
            'cause' => 'Sadavrat Annakshetra Mahaprasad Seva',
            'payment_mode' => 'UPI / Net Banking',
            'status' => 'Verified'
        ]);
        Donation::create([
            'receipt_no' => 'GD-2026-1002',
            'donor_name' => 'Kishorbhai N. Vala',
            'phone' => '+91 98981 44520',
            'pan' => 'BKLPV9981A',
            'amount' => 11000.00,
            'cause' => 'Gaushala Green Fodder & Gau Seva',
            'payment_mode' => 'Bank Transfer (NEFT)',
            'status' => 'Verified'
        ]);
        Donation::create([
            'receipt_no' => 'GD-2026-1003',
            'donor_name' => 'Bhavnaben D. Shah',
            'phone' => '+91 94260 11985',
            'pan' => 'AAACS5512B',
            'amount' => 5100.00,
            'cause' => 'Nitya Aarti & Divine Shringar Fund',
            'payment_mode' => 'UPI (Google Pay)',
            'status' => 'Verified'
        ]);
        Donation::create([
            'receipt_no' => 'GD-2026-1004',
            'donor_name' => 'Dafda Parivar Charitable Trust',
            'phone' => '+91 98790 33214',
            'pan' => 'AAATD7761P',
            'amount' => 51000.00,
            'cause' => 'Yatrik Bhavan Room Construction Fund',
            'payment_mode' => 'Cheque / DD',
            'status' => 'Verified'
        ]);

        // ==========================================
        // 7. ROOM BOOKINGS (2 Realistic Sample Bookings)
        // ==========================================
        RoomBooking::truncate();
        RoomBooking::create([
            'booking_code' => 'GD-BK-101',
            'guest_name' => 'Jitendrabhai Trivedi',
            'phone' => '+91 98240 66789',
            'city' => 'Ahmedabad',
            'room_type' => 'Deluxe AC Room',
            'rooms_count' => 2,
            'guests_count' => 5,
            'check_in' => now()->addDays(3),
            'notes' => 'Visiting with senior citizen parents for Poonam darshan and morning aarti.',
            'status' => 'Approved'
        ]);
        RoomBooking::create([
            'booking_code' => 'GD-BK-102',
            'guest_name' => 'Pravinbhai Vala',
            'phone' => '+91 98982 33412',
            'city' => 'Surat',
            'room_type' => 'Family Non-AC Room',
            'rooms_count' => 1,
            'guests_count' => 4,
            'check_in' => now()->addDays(7),
            'notes' => 'Traveling by private car, reaching by 4:00 PM for evening Sandhya Aarti.',
            'status' => 'Approved'
        ]);

        // ==========================================
        // 8. CONTACT INQUIRIES (3 Devotee Messages)
        // ==========================================
        ContactInquiry::truncate();
        ContactInquiry::create([
            'name' => 'Sureshbhai Vala',
            'phone' => '+91 98255 12345',
            'subject' => 'Navratri Poonam Darshan & Aarti Timing Details',
            'message' => 'Jai Mataji. We are planning to visit Shree Gatrad Dham Devgam with 15 family members on Poonam. Please share the evening Sandhya Aarti time and Mahaprasad timings.'
        ]);
        ContactInquiry::create([
            'name' => 'Dr. Mahendra Parmar',
            'phone' => '+91 98980 67890',
            'subject' => 'Room Booking Inquiry for Yatrik Bhavan',
            'message' => 'Namaste. We wish to book 2 AC guest rooms for an overnight stay from 28th October to 29th October. Kindly confirm availability and check-in procedures.'
        ]);
        ContactInquiry::create([
            'name' => 'Neetaben K. Joshi',
            'phone' => '+91 94280 44567',
            'subject' => 'Annakshetra Tithi Sponsorship (Donor Seva)',
            'message' => 'Jai Mataji. We would like to sponsor full-day Mahaprasad at Sadavrat Annakshetra in memory of our elders next month. Please guide us on the procedure and bank donation details.'
        ]);

        // ==========================================
        // 9. HERO SLIDERS (4 HD Widescreen Banners)
        // ==========================================
        Slider::truncate();
        $sliders = [
            [
                'title_en' => 'Shree Gatrad Dham',
                'title_gu' => 'શ્રી ગાત્રાળ ધામ',
                'subtitle_en' => 'Shree Gatrad Mataji Mandir Charitable Trust, Devgam',
                'subtitle_gu' => 'શ્રી ગાત્રાળ માતાજી મંદિર ચેરીટેબલ ટ્રસ્ટ, દેવગામ',
                'button_text_en' => 'Aarti Schedule',
                'button_text_gu' => 'દૈનિક આરતી સમય',
                'button_link' => '#aarti-schedule',
                'image' => '/uploads/sliders/banner_1.jpg',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title_en' => 'Daily Aarti & Live Darshan',
                'title_gu' => 'દૈનિક આરતી & લાઈવ દર્શન',
                'subtitle_en' => 'Receive Sacred Blessings and Divine Darshan from Home',
                'subtitle_gu' => 'ઘેર બેઠા મેળવો માતાજીના પાવન આશીર્વાદ અને મંગળ દર્શન',
                'button_text_en' => 'Watch Live Darshan',
                'button_text_gu' => 'લાઈવ દર્શન જુઓ',
                'button_link' => '/live-darshan',
                'image' => '/uploads/sliders/banner_2.jpg',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title_en' => 'Sadavrat Mahaprasad Annakshetra',
                'title_gu' => 'સદાવ્રત અન્નક્ષેત્ર મહાપ્રસાદ સેવા',
                'subtitle_en' => 'Free Pure Satvik Meals Served Daily to All Pilgrims',
                'subtitle_gu' => 'મંદિરે પધારતા તમામ ભાવિક ભક્તો માટે નિઃશુલ્ક ભોજન પ્રસાદ',
                'button_text_en' => 'Donate to Annakshetra',
                'button_text_gu' => 'અન્નક્ષેત્રમાં દાન આપો',
                'button_link' => '/donation',
                'image' => '/uploads/sliders/banner_3.jpg',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title_en' => 'Yatrik Dharamshala & Gaushala Seva',
                'title_gu' => 'યાત્રિક ભવન ધર્મશાળા & ગૌશાળા',
                'subtitle_en' => 'Serene AC & Non-AC Guest Rooms & Sacred Gir Cow Protection',
                'subtitle_gu' => 'યાત્રાળુઓ માટે શાંત પરિસરમાં રોકાણ તથા ગૌમાતા સેવા',
                'button_text_en' => 'Book Room Inquiry',
                'button_text_gu' => 'રૂમ પૂછપરછ કરો',
                'button_link' => '/contact',
                'image' => '/uploads/sliders/banner_4.jpg',
                'order' => 4,
                'is_active' => true,
            ],
        ];
        foreach ($sliders as $s) {
            Slider::create($s);
        }
    }
}
