var url = window.location.pathname.split('/')[1]
var dashboard = window.location.pathname

if(dashboard == '/')
{
    document.getElementById('dashboard').classList.add('active', 'active-menu')
}

var highlight = document.getElementById(url)
highlight.classList.add('active')

if(url == 'devices' || url == 'add-device')
{
    document.getElementById('devices-nav').classList.add('active')
    document.getElementById('userinfo').classList.remove('collapse')
}

