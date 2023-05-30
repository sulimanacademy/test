<div class="row  justify-content-center">
	<div class="col-4">
		@for($i = 1; $i <= 2; $i++)
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<select class="custom-select" id="mySelect<?=$i?>" name="mySelect">
						<?php $j = 0; ?>
						@foreach($data as $k=>$v)
							<?php $j++; ?>
							<option value="option<?=$j?>" data-buy="<?=$v['buy']?>"
							        data-sale="<?=$v['sale']?>"><?=$k?></option>
						@endforeach
					</select>
				</div>
				<input type="text" class="form-control" value="1" name="inp<?=$i?>" id="inp<?=$i?>">
			</div>
		@endfor
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

<script>
    window.lastinput = 0;

    $(document).ready(function () {
        $('#mySelect1 option[value="option3"]').prop('selected', true);//default uah
        $('#mySelect2 option[value="option2"]').prop('selected', true);//default usd
        conv($('#inp1').val(), 'buy');
    });

    function conv(sum, buyorsalemode_) {
        let insum_ = 0;
        let outsum_ = 0;
        if ($('#' + 'mySelect1' + ' option:selected').val() === 'option3') { //simple convertation only for UAH
            if (buyorsalemode_ === 'buy') {
                insum_ = sum;
                outsum_ = insum_ / $('#' + 'mySelect2' + ' option:selected').data('sale');
                outsum_ = Math.round(outsum_ * 100) / 100;
                $("#inp2").val(outsum_);
            }
            if (buyorsalemode_ === 'sale') {
                insum_ = sum;
                outsum_ = insum_ * $('#' + 'mySelect2' + ' option:selected').data('buy');
                outsum_ = Math.round(outsum_ * 100) / 100;
                $("#inp1").val(outsum_);
            }
        } else { //double conversion CURR1->UAH->CURR2
            if (buyorsalemode_ === 'buy') {
                insum_ = sum;
                let outsum1 = insum_ * $('#' + 'mySelect1' + ' option:selected').data('buy');// CURR1->UAH
                let outsum2 = outsum1 / $('#' + 'mySelect2' + ' option:selected').data('sale'); // UAH->CURR2
                outsum2 = Math.round(outsum2 * 100) / 100;
                $("#inp2").val(outsum2);
            }
        }
    }

    $(document).on('keyup', function (event) {
            if (event.target.name === 'inp1') {//editing first value
                window.lastinput = 1;
                conv($(event.target).val(), 'buy');
            }
            if (event.target.name === 'inp2') {//editing second value
                window.lastinput = 2;
                conv($(event.target).val(), 'sale');
            }
        }
    );

    $(document).on('change', function (event) {
            if (event.target.id === 'mySelect1') {
                if (window.lastinput === 1) {
                    conv($('#inp1').val(), 'buy');
                }
                if (window.lastinput === 2) {
                    conv($('#inp2').val(), 'buy');
                }
            }
            if (event.target.id === 'mySelect2') {
                if (window.lastinput === 1) {
                    conv($('#inp1').val(), 'buy');
                }
                if (window.lastinput === 2) {
                    conv($('#inp2').val(), 'sale');
                }
            }
        }
    );
</script>
