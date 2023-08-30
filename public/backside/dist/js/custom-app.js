$(document).ready(function () {
    // ==============================================================
    // This is for Show more show less word
    // ==============================================================
    var maximumWordsLength = 10;
    var element = $('td.word-limiter')
    var countLengthOfElement = element.html().split(' ').length

    if (countLengthOfElement > maximumWordsLength) {
        element.each(function (index, val) {
            var showMore = $('<p>').css('cursor', 'pointer').addClass('text-primary show-more').text('Show More')
            var showLess = $('<p>').css('cursor', 'pointer').addClass('text-primary show-less').text('Show Less')

            var fullText = val.innerText

            val.innerText = val.innerText.substr(0, 30) + '...'

            val.append(showMore[0])

            $(this).click(function (e) {

                var selectedElemClass = $(this).children().attr('class').split(' ')[1]

                if (selectedElemClass == 'show-more') {

                    val.innerText = fullText

                    val.append(showLess[0])

                } else if (selectedElemClass == 'show-less') {

                    val.innerText = fullText.substr(0, 30) + '...'

                    val.append(showMore[0])

                }
            })
        })
    }
})

$(document).ready(function () {
    // ==============================================================
    // This is for increase / decrease answers
    // ==============================================================
    let productsData = JSON.parse($('#products').val())
    if ($('div.row.answer-section').length == 1) $('button#decrease').attr('disabled', 'disabled')

    $('#btn-actions-group > .btn-actions').click(function (e) {
        if ($(this).attr('id') == "increase") {

            $('button#decrease').removeAttr('disabled')

            let index = $('div.row.answer-section').length
            let alphabet = String.fromCharCode((index + 1) + 64)

            let formGroupHtml = '';

            formGroupHtml = `
            <div class="row answer-section mt-3">
                <div class="col-md-6">
                    <label class="form-label">Pilih Produk <span class="text-danger">*</span> </label>
                    <div class="form-group mb-3">
                        <select class="form-control" name="produk_id[]">
                            <option value="" selected hidden>Pilih Produk</option>
                            ${productsData.map(product =>
                                `<option value="${product.id}">${product.nama} Stok Sisa: ${product.stok_produk.stok}</option>`
                            ).join('')}
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jumlah Yang Ingin Dipesan <span class="text-danger">*</span> </label>
                    <div class="form-group mb-3">
                        <div class="form-group mb-3">
                            <input type="number" placeholder="Jumlah Yang Ingin Dipesan" class="form-control" placeholder="jumlah" name="jumlah[]" min="0" required>
                        </div>
                    </div>
                </div>
            </div>
            `

            $(formGroupHtml).insertBefore('#answer-section-divider')

            if (alphabet == "Y") $('button#increase').attr('disabled', 'disabled')

        } else if ($(this).attr('id') == "decrease") {

            $('button#decrease').removeAttr('disabled')

            let index = $("div.row.answer-section").length;
            if ((index - 1) == 1) {
                $('button#decrease').attr('disabled', 'disabled')
            } else if (index == 25) {
                $('button#increase').removeAttr('disabled')
            }
            console.log(index)
            $("div.row.answer-section").last().remove()

        }
    })

})


$(document).ready(function () {
    // ==============================================================
    // This is for Show Image Input type file
    // ==============================================================

    $('input[type="file"].input-image-type').change(function (e) {
        let reader = new FileReader()
        reader.onload = function (e) {
            $('#show-image-from-input').css({
                'width': '233.33px',
                'height': '233.33px'
            }).attr('src', e.target.result)
        }

        reader.readAsDataURL(e.target.files[0])
    })

})




