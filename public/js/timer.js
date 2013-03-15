function timer_refresh()
{
	timer = document.querySelector(".timer");
	text = timer.firstElementChild.innerHTML;

	if (text == 'Time out!')
		return;
	
	m = Number(text.split(':')[0]);
	s = Number(text.split(':')[1]);

	s -= 1;
	if (s == -1)
	{
		s = 59;
		m -= 1;
	}
	if (m == -1)
	{
		timer.firstElementChild.innerHTML = 'Time out!';
		return;
	}

	text = (m < 10 ? '0' : '') + m.toString() + ' : ' + (s < 10 ? '0' : '') + s.toString();
	timer.firstElementChild.innerHTML = text;
}

if (timer = document.querySelector(".timer"))
{
	clock = document.createElement('div');
	clock.innerHTML = '05 : 00';

	timer.appendChild(clock);
	setInterval(timer_refresh, 1000);
}
