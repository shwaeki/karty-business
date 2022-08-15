
function saveChanges() {
    Swal.fire({
        title: 'هل تريد حفظ التغييرات ؟',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'حفظ',
        denyButtonText: `تجاهل`,
        cancelButtonText: `الغاء`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            Swal.fire('تم الحفظ!', '', 'بنجاح')
        } else if (result.isDenied) {
            Swal.fire('لم يتم حفظ', '', 'التغييرات')
        }
    })
}


function cancelOrder() {
    Swal.fire({
        title: 'هل انت متأكد من رغبتك بإلغاء الطلب ؟',
        text: "لن تستطيع إستعادة الطلب مرة أخرى",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'نعم، قم بالإلغاء!',
        cancelButtonText: 'لا'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'تم الغاء الطلب بنجاح!'
            )
        }
    })
}


