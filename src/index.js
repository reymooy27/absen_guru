document.addEventListener('DOMContentLoaded', () => {
  const menu = document.getElementById('menu')
  const close = document.getElementById('close')
  const sidebar = document.getElementsByClassName('sidebar')
  const btnEdit = document.querySelectorAll('#editGuruBtn')
  const modalEditForm = document.getElementById('formEditGuru')


  menu.addEventListener('click',()=>{
    sidebar[0].classList.toggle('open')
  })

  close.addEventListener('click',()=>{
    sidebar[0].classList.remove('open')
  })

  btnEdit.forEach(btn=>{
    btn.addEventListener('click', ()=>{
      const data = JSON.parse(btn.dataset.guru)
      modalEditForm['nama'].value = data.nama
      modalEditForm['nip'].value = data.nip
      modalEditForm['jabatan'].value = data.jabatan
      modalEditForm['username'].value = data.username
      modalEditForm['password'].value = data.password
      modalEditForm[6].value = data.isAdmin
      modalEditForm[6].checked = data.isAdmin > 0 ? true : false
      modalEditForm.action = `./controllers/editGuru.php?id=${data.id}`
    })
  })




})