import Swal from "sweetalert2";

let swal = {
    showLoading: () => {
        Swal.fire({
            html: `
            <div style="overflow-y: hidden;">
                <div class="spinner-border">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            `,
            allowEscapeKey:false,
            allowOutsideClick: false,
            showConfirmButton: false,
        });
    },

    fire: (icon,title,message) => {
        Swal.fire({
            icon: icon,
            title: title,
            text: message,
          })
    },

    confirm: (message, callback) => {
        Swal.fire({
            title: message,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then(callback)
    },

    toast: (status, message) => {
        Swal.fire({
            title: message,
            toast:true,
            icon: status,
            position: 'top-end',
            showConfirmButton: false,
            timerProgressBar: true,          
            timer: 3000
        });
    },

    close: () => {
        Swal.close();
    },
};

export default swal;
