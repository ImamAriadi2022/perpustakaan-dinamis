var currentUsername = '';

document.addEventListener("DOMContentLoaded", function(event) {

    fetch('../../../backend/php/user/get_user.php')
    .then(response => response.text())
    .then(username => {
        const temporaryElement = document.getElementById('username');
        currentUsername = username;
        if (temporaryElement) {
            temporaryElement.innerHTML = username;
        }
    })
    .catch(error => console.error('Error fetching username:', error));

    document.getElementById('beranda-btn').addEventListener('click', function() {
        document.getElementById('result-tag').setAttribute('hidden', true);
        document.getElementById('main-content').innerHTML = `
            <div>
                <h1 class="text-2xl font-medium text-center">Selamat datang <a id="username" class="text-accent bg-black px-2">${currentUsername}</a> di Perpustakaan ts0ra!</h1>
                <p class="text-center">Silahkan pilih menu yang tersedia di atas.</p>

                <hr class="m-5 border-2 border-secondary">

                <div class="user-reviews m-5">
                    <h3 class="text-2xl font-semibold mb-3">Komentar Pengguna</h3>
                    <div class="review bg-white p-4 rounded-lg shadow mb-4">
                        <p class="text-base">"Aplikasi perpustakaan online ini sangat membantu saya dalam mengakses buku kapan saja dan di mana saja. Koleksi bukunya sangat lengkap!"</p>
                        <p class="text-xs text-right">- Siti Rahmawati</p>
                    </div>
                    
                    <div class="review bg-white p-4 rounded-lg shadow mb-4">
                        <p class="text-base">"Sistem pencarian buku di aplikasi ini sangat cepat dan akurat. Saya selalu menemukan buku yang saya cari dengan mudah."</p>
                        <p class="text-xs text-right">- Ahmad Fauzi</p>
                    </div>
                    
                    <div class="review bg-white p-4 rounded-lg shadow mb-4">
                        <p class="text-base">"Antarmuka yang sederhana dan mudah digunakan membuat aplikasi ini menjadi favorit saya untuk mencari referensi bacaan."</p>
                        <p class="text-xs text-right">- Maria Yuliana</p>
                    </div>
                    
                    <div class="review bg-white p-4 rounded-lg shadow mb-4">
                        <p class="text-base">"Koleksi buku yang sangat beragam dan selalu update. Saya senang sekali menggunakan aplikasi ini."</p>
                        <p class="text-xs text-right">- Dedi Irawan</p>
                    </div>
                    
                    <div class="review bg-white p-4 rounded-lg shadow mb-4">
                        <p class="text-base">"Aplikasi ini mempermudah saya mengakses berbagai buku dari berbagai genre tanpa perlu pergi ke perpustakaan."</p>
                        <p class="text-xs text-right">- Lisa Febrianti</p>
                    </div>
                    
                    <div class="review bg-white p-4 rounded-lg shadow mb-4">
                        <p class="text-base">"Pelayanan pelanggan yang cepat dan responsif. Saya sangat puas dengan layanan aplikasi perpustakaan ini."</p>
                        <p class="text-xs text-right">- Bambang Sutrisno</p>
                    </div>
                    
                    <div class="review bg-white p-4 rounded-lg shadow mb-4">
                        <p class="text-base">"Aplikasi ini sangat membantu dalam mencari literatur untuk tugas-tugas kuliah saya. Sangat recommended!"</p>
                        <p class="text-xs text-right">- Rina Kurniawati</p>
                    </div>               
                </div>
            </div>
        `;
    });

    document.getElementById('buku-saya-btn').addEventListener('click', function() {
        document.getElementById('result-tag').setAttribute('hidden', true);
        fetch('../../../backend/php/user/get_user_books.php')
            .then(response => response.json())
            .then(data => {
                if (data.message == 0) {
                    document.getElementById('main-content').innerHTML = `
                        <h1 class="text-2xl font-medium text-center">Daftar Buku</h1>
                        <p class="text-center"><a id="username" class="text-accent bg-black px-2">${currentUsername}</a> belum meminjam buku apapun.</p>
                    `;
                    return;
                }
                // Construct HTML for displaying user's borrowed books
                let booksHtml = `
                    <h1 class="text-2xl font-medium text-center">Daftar Buku</h1>
                    <p class="text-center">Terdapat ${data.length} buku yang dipinjam oleh <a id="username" class="text-accent bg-black px-2">${currentUsername}</a></p>
                
                    <hr class="m-5 border-2 border-secondary">
                
                    <div class="user-books m-5">
                `;

                // Loop through each book data and create HTML for each
                data.forEach(book => {
                    booksHtml += `
                        <div class="book bg-white p-4 rounded-lg shadow mb-4">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <img src="${book.image_url}" alt="${book.title}" class="w-20 h-20 object-cover rounded-lg shadow-lg">
                                    <div class="ml-4">
                                        <h4 class="text-lg font-semibold">${book.title}</h4>
                                        <p class="text-sm">Author: ${book.author}</p>
                                        <p class="text-sm">Tanggal peminjaman: ${book.loan_date}</p>
                                        <p class="text-sm">Tanggal pengembalian: ${book.return_date}</p>
                                    </div>
                                </div>
                                <button class="bg-accent hover:bg-accent_dark active:bg-accent focus:bg-accent_dark focus:outline-none focus:ring focus:ring-accent_ring focus:text-neutral-50 font-bold py-2 px-4 rounded return-book-btn" value=${book.loan_id}>
                                    Kembalikan
                                </button>
                            </div>
                        </div>
                    `;
                });

                // Close the HTML structure
                booksHtml += `</div></div>`;

                // Update the main-content element with the constructed HTML
                document.getElementById('main-content').innerHTML = booksHtml;

                            // Attach event listeners to the "Kembalikan" buttons
                document.querySelectorAll('.return-book-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const loanId = this.getAttribute('value');
                        returnBook(loanId);
                    });
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    });

    document.getElementById('koleksi-buku-btn').addEventListener('click', function() {
        document.getElementById('result-tag').setAttribute('hidden', true);
        fetch('../../../backend/php/user/get_all_books.php')
            .then(response => response.json())
            .then(data => {
                if (data.message == 0) {
                    document.getElementById('main-content').innerHTML = `
                        <h1 class="text-2xl font-medium text-center">Koleksi Buku</h1>
                        <p class="text-center">Belum ada buku yang tersedia.</p>
                    `;
                    return;
                }
                // Construct HTML for displaying user's borrowed books
                let booksHtml = `
                    <h1 class="text-2xl font-medium text-center">Koleksi Buku</h1>
                    <p class="text-center">Terdapat ${data.length} buku yang tersedia untuk dipinjam</p>
                
                    <hr class="m-5 border-2 border-secondary">
                
                    <div class="user-books m-5">
                `;
    
                // Loop through each book data and create HTML for each
                data.forEach(book => {
                    booksHtml += `
                        <div class="book bg-white p-4 rounded-lg shadow mb-4">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <img src="${book.image_url}" alt="${book.title}" class="w-20 h-20 object-cover rounded-lg shadow-lg">
                                    <div class="ml-4">
                                        <h4 class="text-lg font-semibold">${book.title}</h4>
                                        <p class="text-sm">Pengarang: ${book.author}</p>
                                        <p class="text-sm">Penerbit: ${book.publisher}</p>
                                        <p class="text-sm">Tahun Terbit: ${book.year}</p>
                                    </div>
                                </div>
                                <button class="bg-accent hover:bg-accent_dark active:bg-accent focus:bg-accent_dark focus:outline-none focus:ring focus:ring-accent_ring focus:text-neutral-50 font-bold py-2 px-4 rounded loan-book-btn" value=${book.book_id}>
                                    Pinjam
                                </button>
                            </div>
                        </div>
                    `;
                });
    
                // Close the HTML structure
                booksHtml += `</div></div>`;
    
                // Update the main-content element with the constructed HTML
                document.getElementById('main-content').innerHTML = booksHtml;

                document.querySelectorAll('.loan-book-btn').forEach(button => {
                    button.addEventListener('click', function() {
                        const bookId = this.getAttribute('value');
                        loanBook(bookId);
                    });
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    });

    document.getElementById('logout-btn').addEventListener('click', function() {
        document.getElementById('result-tag').setAttribute('hidden', true);
        fetch('../../../backend/php/user/logout.php')
            .then(response => response.json())
            .then(data => {
                if (data.code == 200) {
                    window.location.href = '../../../index.html';
                } else {
                    console.error('Error logging out:', data.message);
                }
            })
            .catch(error => {
                console.error('Error logging out:', error);
            });
    });

    document.getElementById('chatbot-btn').addEventListener('click', function() {
        document.getElementById('result-tag').setAttribute('hidden', true);
        window.location.replace("http://127.0.0.1:5000");
    });

    const returnButton = document.getElementById('return-btn');
    if (returnButton) {
        returnButton.addEventListener('click', function() {
            console.log('Return button clicked');
        });
    }

    function returnBook(loanId) {
        fetch('../../../backend/php/user/return_book.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ loan_id: loanId }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.code == 200) {
                document.getElementById('buku-saya-btn').click();
                document.getElementById('result-tag').removeAttribute('hidden');
                document.getElementById('result-tag').innerHTML = data.message;
            } else {
                document.getElementById('result-tag').removeAttribute('hidden');
                document.getElementById('result-tag').innerHTML = data.message;
            }
        })
        .catch(error => {
            console.error('Error returning book:', error);
        });
    }

    function loanBook(bookId) { // loan book
        fetch('../../../backend/php/user/loan_book.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ book_id: bookId }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.code == 200) {
                document.getElementById('koleksi-buku-btn').click();
                document.getElementById('result-tag').removeAttribute('hidden');
                document.getElementById('result-tag').innerHTML = data.message;
            } else {
                document.getElementById('result-tag').removeAttribute('hidden');
                document.getElementById('result-tag').innerHTML = data.message;
            }
        })
        .catch(error => {
            console.error('Error returning book:', error);
        });
    }

});