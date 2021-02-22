<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:800px">
    <header class="w3-container w3-border-bottom">
        <h4><i class="fa fa-home"></i> تحديث بيانات العقار </h4>
        <a href="javascript::void()" onclick="document.getElementById('edit_agar_{{ $agar->id }}').style.display='none'" class="w3-btn w3-display-topleft">&times;</a>
    </header>
    <div class="">
        <form id="agar_{{ $agar->id }}" action="{{ route('agars.edit') }}" method="post" enctype="multipart/form-data" class="w3-padding-large">
           @csrf
            <div class="w3-row-padding">
                <div class="w3-margin-bottom w3-third">
                    <label for="agar_name">الاسم</label>
                    <input id="agar_name"  name="agar_name" class="w3-input" type="text" placeholder="الاسم"
                           required value="{{ $agar->agar_name }}">
                </div>
                <div class="w3-margin-bottom w3-third">
                    <label for="type_id">نوع العقار</label>
                    <select id="type_id" class="w3-input" name="type_id">
                      @foreach($agarType as $type)
                        <option required="required" id="type_id_1"
                                value="{{ $type->type_id }}">{{ $type->type_name }}</option>
                      @endforeach
                    </select>
                </div>
                <div id="floor_container" class="w3-margin-bottom w3-third">
                    <label for="floor_id">الطابق</label>
                    <select id="floor_id" class="w3-input" name="floor_id">
                      @foreach($agarFloor as $floor)
                        <option id="floor_id_0"
                                value="{{ $floor->floor_id }}">{{ $floor->floor_name }}</option>
                      @endforeach
                    </select>
                </div>
            </div>
            <div class="w3-margin-bottom w3-padding">الموقع الجغرافي</div>
            <div class="w3-row-padding">
                <div class="w3-margin-bottom w3-third">
                    <label for="state_id">الولاية</label>
                    <select id="state_id" class="w3-input" name="state_id">
                      @foreach($states as $state)
                        <option id="state_id_1"
                                selected value="{{ $state->state_id }}">{{ $state->state_name }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="w3-margin-bottom w3-third">
                    <label for="city_id">المدينة</label>
                    <select id="city_id" class="w3-input" name="city_id">
                      @foreach($citys as $city)
                        <option id="city_id_1"
                                value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="w3-margin-bottom w3-third">
                    <label for="area">الحي</label>
                    <input id="area"  name="area" class="w3-input" type="text"
                           placeholder="الحي" required value="{{ $agar->location->area }}">
                </div>
            </div>
            <div class="w3-row-padding">
                <div class="w3-margin-bottom w3-half">
                    <label for="rooms_number">عدد الغرف</label>
                    <input id="rooms_number"  name="rooms_number" class="w3-input" type="number"
                           placeholder="عدد الغرف" required  value="{{ $agar->rooms_number }}">
                </div>
                <div class="w3-margin-bottom w3-half">
                    <label for="bathrooms_number">عدد الحمامات</label>
                    <input id="bathrooms_number"  name="bathrooms_number" class="w3-input" type="number"
                           placeholder="عدد الحمامات" required value="{{ $agar->bathrooms_number }}">
                </div>
            </div>

            <div class="w3-margin-bottom w3-padding">
                <label for="agar_desc">الوصف</label>
                <textarea id="agar_desc" name="agar_desc" class="w3-input" required>{{ $agar->agar_desc }}
                </textarea>
            </div>

            <input type="hidden" name="agar_id" value="{{ $agar->id }}" />
            <input type="hidden" name="geo_loc_id" value="{{ $agar->geo_loc_id }}" />
        </form>
    </div>
    <footer class="w3-container">
        <div class="w3-section w3-right">
            <button form="agar_{{ $agar->id }}" type="submit" name="edit_agar" value="حفظ"
            class="w3-button w3-border w3-hover-light-gray w3-text-gray w3-round" style="padding: 7px 15px;">
                <i class="fa fa-save"></i> حفظ</button>
            <a href="javascript::void()" onclick="document.getElementById('edit_agar_{{ $agar->id }}').style.display='none'"  class="w3-button w3-border w3-hover-light-gray w3-text-gray w3-round" style="padding: 7px 15px;"><i class="fa fa-close"></i> إلغاء</a>
        </div>
    </footer>
</div><!-- END New agar Form -->
</div>
