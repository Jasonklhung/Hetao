@extends('layout.app')

@section('content')
		<div class="main">
            <div class="main-content">
                <div class="container-fluid">
                    <!-- 活動分析 -->
                    <h3 class="page-title">業務管理</h3>
                    <div class="panel bg-transparent">
                        <div class="panel-body">
                            <div class="row">
                                <!-- 分析數據-->
                                <div class="col-md-12 wrap">
                                    <div class="panel" id="manager">
                                        <div class="panel-title">
                                            <i class="fas fa-briefcase"></i>個人業務 - 業務拜訪紀錄
                                        </div>
                                        <div class="panel-body">
                                            <div class="tabbable">
                                                <form method="post" enctype="multipart/form-data" action="{{ route('ht.Business.self.store',['organization'=>$organization]) }}">
                                                    @csrf
                                                    <div class="col-sm-6">
                                                        <div class="form-item">
                                                            <label class="d-block"><span class="text-danger">* </span>拜訪日期</label>
                                                            <div class="datetime">
                                                                <div class="input-group date day-set">
                                                                    <input class="form-control" placeholder="請選擇日期" name="date" type="text" required=""> <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-item">
                                                            <label class="d-block"><span class="text-danger">* </span>業務人員</label>
                                                            <input type="text" class="form-control" name="business_name" value="{{ Auth::user()->name }}" required="">
                                                        </div>
                                                        <div class="form-item">
                                                            <label class="d-block"><span class="text-danger">* </span>拜訪時間</label>
                                                            <select class="form-control mr-s" name="time" required="">
                                                                <option selected hidden disabled value="">請選擇</option>
                                                                <option value="上午(AM)">上午(AM)</option>
                                                                <option value="下午(PM)">下午(PM)</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-item">
                                                            <label class="d-block"><span class="text-danger">* </span>業主名稱</label>
                                                            <input type="text" name="name" class="form-control" required="">
                                                        </div>
                                                        <div class="form-item">
                                                            <label class="d-block"><span class="text-danger">* </span>拜訪類型</label>
                                                            <label class="d-inline mr-m"><input type="checkbox" name="type[]" checked="" class="mr-s" value="拜訪">拜訪</label>
                                                            <label class="d-inline mr-m"><input type="checkbox" name="type[]" class="mr-s" value="陌訪">陌訪</label>
                                                            <label class="d-inline mr-m"><input type="checkbox" name="type[]" class="mr-s" value="洽機">洽機</label>
                                                            <label class="d-inline mr-m"><input type="checkbox" name="type[]" class="mr-s" value="看現場">看現場</label>
                                                            <label class="d-inline mr-m"><input type="checkbox" name="type[]" class="mr-s" value="送機器">送機器</label>
                                                            <label class="d-inline mr-m"><input type="checkbox" name="type[]" class="mr-s" value="收款">收款</label>
                                                            <label class="d-inline mr-m"><input type="checkbox" name="type[]" class="mr-s" value="送文件">送文件</label>
                                                            <label class="d-inline mr-m"><input type="checkbox" name="type[]" class="mr-s" value="協助安裝">協助安裝</label>
                                                            <label class="d-inline mr-m"><input type="checkbox" name="type[]" class="mr-s" value="其他">其他</label>
                                                            <label class="d-inline mr-m"><input type="checkbox" name="type[]" class="mr-s" value="支援">支援</label>
                                                            <label class="d-inline mr-m"><input type="checkbox" name="type[]" class="mr-s" value="客訴">客訴</label>
                                                            <label class="d-inline mr-m"><input type="checkbox" name="type[]" class="mr-s" value="客服">客服</label>
                                                        </div>
                                                        <div class="form-item">
                                                            <label class="d-block"><span class="text-danger">* </span>拜訪內容</label>
                                                            <input type="text" class="form-control" name="content" required="">
                                                        </div>
                                                    </div>    

                                                    <div class="col-sm-6">
                                                        <div class="form-item">
                                                            <label class="d-block"><span class="text-danger">* </span>拜訪地址</label>
                                                            <div class="d-flex mb-s">
                                                                <select class="form-control mr-s area1" name="city" required="">
                                                                    <option selected hidden disabled value="">縣市</option>
                                                                </select>

                                                                <select class="form-control ml-s area2" name="area" required="">
                                                                    <option selected hidden disabled value="">鄉鎮市</option>
                                                                </select>
                                                            </div>    
                                                            <input type="text" class="form-control" placeholder="地址" name="address" required="">
                                                        </div>
                                                        <div class="form-item">
                                                            <label class="d-block"><span class="text-danger">* </span>聯絡電話</label>
                                                            <input type="number" class="form-control" placeholder="聯絡電話" name="phone" required="">
                                                        </div>
                                                        <div class="form-item">
                                                            <label class="d-block">備註其他</label>
                                                            <textarea rows="5" class="form-control" placeholder="" name="other"></textarea>
                                                        </div>
                                                        <div class="form-item">
                                                            <label class="d-block">附件上傳</label>
                                                            <input type="file" class="d-none upload" id="upload" name="file" accept=".csv,.xls,.xlsx,.doc,.docx,.pdf" onchange="checkfile(this);">
                                                            <label class="form-control" for="upload">上傳附件</label>
                                                        </div>
                                                        <div class="form-item ">
                                                            <span class="d-block">狀態
                                                                <label class="switch follow-status">
                                                                    <input type="checkbox" checked name="statusTrack">
                                                                    <span class="slider round"></span>
                                                                </label>
                                                            </span>
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-sm-12 mb-s">
                                                        <a href="{{ route('ht.Business.self.index',['organization'=>$organization]) }}"><button type="button" class="btn btn-default">返回</button></a>
                                                        <button type="submit" class="btn btn-primary">新增</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('modal')

@endsection

@section('scripts')
<script>
	$('.upload').on('change', function(e){
		var files = e.target.files
		var fileName = files[0].name
		$(this).siblings('label[for="upload"]').html(`<i class="fas fa-paperclip text-primary"></i> `+ fileName);
	});

    function checkfile(sender) {

      var validExts = new Array(".xlsx", ".xls", ".csv",".doc",".docx",".pdf");

      var fileExt = sender.value;
      fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
        if (validExts.indexOf(fileExt) < 0) {
            alert("檔案類型錯誤，可接受的副檔名有：" + validExts.toString());
            sender.value = null;
            return false;
        }
        else return true;
    }
</script>
<script>
            var area_data = {
            '臺北市': [
                '中正區', '大同區', '中山區', '萬華區', '信義區', '松山區', '大安區', '南港區', '北投區', '內湖區', '士林區', '文山區'
            ],
            '新北市': [
                '板橋區', '新莊區', '泰山區', '林口區', '淡水區', '金山區', '八里區', '萬里區', '石門區', '三芝區', '瑞芳區', '汐止區', '平溪區', '貢寮區', '雙溪區', '深坑區', '石碇區', '新店區', '坪林區', '烏來區', '中和區', '永和區', '土城區', '三峽區', '樹林區', '鶯歌區', '三重區', '蘆洲區', '五股區'
            ],
            '基隆市': [
                '仁愛區', '中正區', '信義區', '中山區', '安樂區', '暖暖區', '七堵區'
            ],
            '桃園市': [
                '桃園區', '中壢區', '平鎮區', '八德區', '楊梅區', '蘆竹區', '龜山區', '龍潭區', '大溪區', '大園區', '觀音區', '新屋區', '復興區'
            ],
            '新竹縣': [
                '竹北市', '竹東鎮', '新埔鎮', '關西鎮', '峨眉鄉', '寶山鄉', '北埔鄉', '橫山鄉', '芎林鄉', '湖口鄉', '新豐鄉', '尖石鄉', '五峰鄉'
            ],
            '新竹市': [
                '東區', '北區', '香山區'
            ],
            '苗栗縣': [
                '苗栗市', '通霄鎮', '苑裡鎮', '竹南鎮', '頭份鎮', '後龍鎮', '卓蘭鎮', '西湖鄉', '頭屋鄉', '公館鄉', '銅鑼鄉', '三義鄉', '造橋鄉', '三灣鄉', '南庄鄉', '大湖鄉', '獅潭鄉', '泰安鄉'
            ],
            '臺中市': [
                '中區', '東區', '南區', '西區', '北區', '北屯區', '西屯區', '南屯區', '太平區', '大里區', '霧峰區', '烏日區', '豐原區', '后里區', '東勢區', '石岡區', '新社區', '和平區', '神岡區', '潭子區', '大雅區', '大肚區', '龍井區', '沙鹿區', '梧棲區', '清水區', '大甲區', '外埔區', '大安區'
            ],
            '南投縣': [
                '南投市', '埔里鎮', '草屯鎮', '竹山鎮', '集集鎮', '名間鄉', '鹿谷鄉', '中寮鄉', '魚池鄉', '國姓鄉', '水里鄉', '信義鄉', '仁愛鄉'
            ],
            '彰化縣': [
                '彰化市', '員林鎮', '和美鎮', '鹿港鎮', '溪湖鎮', '二林鎮', '田中鎮', '北斗鎮', '花壇鄉', '芬園鄉', '大村鄉', '永靖鄉', '伸港鄉', '線西鄉', '福興鄉', '秀水鄉', '埔心鄉', '埔鹽鄉', '大城鄉', '芳苑鄉', '竹塘鄉', '社頭鄉', '二水鄉', '田尾鄉', '埤頭鄉', '溪州鄉'
            ],
            '雲林縣': [
                '斗六市', '斗南鎮', '虎尾鎮', '西螺鎮', '土庫鎮', '北港鎮', '莿桐鄉', '林內鄉', '古坑鄉', '大埤鄉', '崙背鄉', '二崙鄉', '麥寮鄉', '臺西鄉', '東勢鄉', '褒忠鄉', '四湖鄉', '口湖鄉', '水林鄉', '元長鄉'
            ],
            '嘉義縣': [
                '太保市', '朴子市', '布袋鎮', '大林鎮', '民雄鄉', '溪口鄉', '新港鄉', '六腳鄉', '東石鄉', '義竹鄉', '鹿草鄉', '水上鄉', '中埔鄉', '竹崎鄉', '梅山鄉', '番路鄉', '大埔鄉', '阿里山鄉'
            ],
            '嘉義市': [
                '東區', '西區'
            ],
            '臺南市': [
                '中西區', '東區', '南區', '北區', '安平區', '安南區', '永康區', '歸仁區', '新化區', '左鎮區', '玉井區', '楠西區', '南化區', '仁德區', '關廟區', '龍崎區', '官田區', '麻豆區', '佳里區', '西港區', '七股區', '將軍區', '學甲區', '北門區', '新營區', '後壁區', '白河區', '東山區', '六甲區', '下營區', '柳營區', '鹽水區', '善化區', '大內區', '山上區', '新市區', '安定區'
            ],
            '高雄市': [
                '楠梓區', '左營區', '鼓山區', '三民區', '鹽埕區', '前金區', '新興區', '苓雅區', '前鎮區', '小港區', '旗津區', '鳳山區', '大寮區', '鳥松區', '林園區', '仁武區', '大樹區', '大社區', '岡山區', '路竹區', '橋頭區', '梓官區', '彌陀區', '永安區', '燕巢區', '田寮區', '阿蓮區', '茄萣區', '湖內區', '旗山區', '美濃區', '內門區', '杉林區', '甲仙區', '六龜區', '茂林區', '桃源區', '那瑪夏區'
            ],
            '屏東縣': [
                '屏東市', '潮州鎮', '東港鎮', '恆春鎮', '萬丹鄉', '長治鄉', '麟洛鄉', '九如鄉', '里港鄉', '鹽埔鄉', '高樹鄉', '萬巒鄉', '內埔鄉', '竹田鄉', '新埤鄉', '枋寮鄉', '新園鄉', '崁頂鄉', '林邊鄉', '南州鄉', '佳冬鄉', '琉球鄉', '車城鄉', '滿州鄉', '枋山鄉', '霧台鄉', '瑪家鄉', '泰武鄉', '來義鄉', '春日鄉', '獅子鄉', '牡丹鄉', '三地門鄉'
            ],
            '宜蘭縣': [
                '宜蘭市', '羅東鎮', '蘇澳鎮', '頭城鎮', '礁溪鄉', '壯圍鄉', '員山鄉', '冬山鄉', '五結鄉', '三星鄉', '大同鄉', '南澳鄉'
            ],
            '花蓮縣': [
                '花蓮市', '鳳林鎮', '玉里鎮', '新城鄉', '吉安鄉', '壽豐鄉', '秀林鄉', '光復鄉', '豐濱鄉', '瑞穗鄉', '萬榮鄉', '富里鄉', '卓溪鄉'
            ],
            '臺東縣': [
                '臺東市', '成功鎮', '關山鎮', '長濱鄉', '海端鄉', '池上鄉', '東河鄉', '鹿野鄉', '延平鄉', '卑南鄉', '金峰鄉', '大武鄉', '達仁鄉', '綠島鄉', '蘭嶼鄉', '太麻里鄉'
            ],
            '澎湖縣': [
                '馬公市', '湖西鄉', '白沙鄉', '西嶼鄉', '望安鄉', '七美鄉'
            ],
            '金門縣': [
                '金城鎮', '金湖鎮', '金沙鎮', '金寧鄉', '烈嶼鄉', '烏坵鄉'
            ],
            '連江縣': [
                '南竿鄉', '北竿鄉', '莒光鄉', '東引鄉'
            ]
        };
        
        // 台灣縣市載入
        $(document).ready(function(){
            $(".area1").append('<option selected hidden value="" disabled>選擇縣市</option>');
            for(var i=0;i<Object.keys(area_data).length;i++){
            $(".area1").append("<option value='"+Object.keys(area_data)[i]+"'>"+Object.keys(area_data)[i]+"</option>")
            }
        });

        // 台灣縣市變動時地區載入
        $(".area1").change(function(){
            var val=$(this).val();
            $(".area2").html('');
            $(".area2").append('<option class="append-start" selected value="">鄉鎮市</option>');
            for(i=0;i<area_data[val].length;i++){
                $(".area2").append("<option value='"+area_data[val][i]+"'>"+area_data[val][i]+"</option>")
            }
        });
</script>
@endsection