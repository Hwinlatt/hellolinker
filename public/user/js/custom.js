$(document).ready(function () {
    if (!localStorage.getItem('language')) {
        localStorage.setItem('language', 'eng');
    }
    selLanguage();

    $('#languages a').click(function (e) {
        e.preventDefault();
        localStorage.setItem('language', $(this).attr('language'));
        selLanguage();
    });

    //comment delete
    $('.delCmtBtn').click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = $(this).attr('href');
            }
        })

    });

});



//Useful Function
let selLanguage = () => {
    let userChoose = localStorage.getItem('language');
    if (userChoose == 'mm') {
        $('input[name="searchKey"]').attr('placeholder', 'ရှာဖွေရန်')
    }
    if (userChoose == 'eng') {
        $('input[name="searchKey"]').attr('placeholder', 'Enter Search')
    }
    $('span[language]').hide();
    $(`span[language=${userChoose}]`).show()
    $('.selLanguage').html($(`a[language=${userChoose}]`).html())
}

let ratingFunction = () => {
    $('.cmtRating').change(function () {
        let val = $(this).val();
        let cls = 'border border-4 scaletwo';
        let text = [
            '<span language="eng">bad</span><span language="mm">ဆိုးသော</span>',
            '<span language="eng">normal</span><span language="mm">သာမန်</span>',
            '<span language="eng">good</span><span language="mm">ကောင်းသော</span>',
            '<span language="eng">excellent</span><span language="mm">အကောင်ဆုံး</span>',
        ]
        $('.ratingIconContainer i').removeClass(cls);
        $(`.ratIcon-${val}`).addClass(cls);
        $.each(text, function (index, text) {
            if (val == index + 1) {
                $('#ratText').html(text);
                selLanguage();
            }
        });

    })

    $('.ratingIconContainer i').click(function () {
        for (let i = 1; i < 5; i++) {
            if ($(this).hasClass('ratIcon-' + i)) {
                $('.cmtRating').val(i).change()
            }
        }
    })
}





