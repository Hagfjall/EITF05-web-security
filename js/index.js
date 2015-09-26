// this script tabulates all users in the database, using innerHTML
// normally this wouldn't be used to display all registered users, but
// rather something like comments/posts/statuses/... user provided input.  
window.onload = function () {
	// we don't care about browsers that don't support XHR
	var xhr = new XMLHttpRequest()
	xhr.open("GET", "/users.php")
	xhr.onreadystatechange = function () {
		// also, we don't care if the request succeeded or not (200)
		// because this is just a sham :>
		if (xhr.readyState === 4)
			setupUserList(JSON.parse(xhr.responseText))
	}
	xhr.send()

	// give it a list of users and watch the world burn
	function setupUserList (users) {
		// the returned html in index.php has this div
		var tag = document.getElementById("tableTag")
		var table = document.createElement('table')

		// function to insecurely handle user data
		// the actual vulnerability is that we use 'innerHTML'
		// in favour over the safe 'textContent'
		var createUser = function (email, username, address) {
			// if you don't like logs, please, be my guest
			console.log('creating user', email, username, address)

			var row = document.createElement('tr')

			var e = document.createElement('td')
			e.innerHTML = email

			var u = document.createElement('td')
			u.innerHTML = username

			var a = document.createElement('td')
			a.innerHTML = address

			// remember to add in same order as the header
			row.appendChild(e)
			row.appendChild(u)
			row.appendChild(a)

			return row
		}

		// append the table header
		// header format is: EMAIL | USERNAME | ADDRESS 
		// (NOTE: why are we giving address??)
		table.appendChild(
			// yes, i agree, this is a bit crazy
			(function () {
				var row = document.createElement('tr')

				var email = document.createElement('th')
				email.textContent = 'email'

				var username = document.createElement('th')
				username.textContent = 'username'

				var address = document.createElement('th')
				address.textContent = 'address'

				row.appendChild(email)
				row.appendChild(username)
				row.appendChild(address)

				return row
			})()
		)

		users.forEach(function (user) {
			table.appendChild(createUser(user.email, user.name, user.address))
		})

		tag.appendChild(table)
	}
}