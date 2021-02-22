<div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:800px">
    <header class="w3-container w3-border-bottom">
        <h4><i class="fa fa-home"></i> نموذج عقار</h4>
        <a href="javascript::void()" onclick="document.getElementById('NEW_AGAR_FORM').style.display='none'" class="w3-btn w3-display-topleft">&times;</a>
    </header>
    <div id="add_agar">
        <form id="agar" action="agars/add" method="post" enctype="multipart/form-data" class="w3-padding-large">
          @csrf
          <addagar-app :types="{{ $agarType }}" :states="{{ $states }}"></addagar-app>
        </form>
    </div>
    <footer class="w3-container">
        <div class="w3-section w3-right">
            <button form="agar" type="submit" name="save_agar" value="حفظ"
            class="w3-button w3-border w3-hover-light-gray w3-text-gray w3-round" style="padding: 7px 15px;">
                <i class="fa fa-save"></i> حفظ</button>
            <a href="javascript::void()" onclick="document.getElementById('NEW_AGAR_FORM').style.display='none'"  class="w3-button w3-border w3-hover-light-gray w3-text-gray w3-round" style="padding: 7px 15px;"><i class="fa fa-close"></i> إلغاء</a>
        </div>
    </footer>
</div><!-- END New agar Form -->
</div>
