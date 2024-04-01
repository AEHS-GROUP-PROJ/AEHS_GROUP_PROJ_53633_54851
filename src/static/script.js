(function () {
	"use strict";

	let loading = false
	let messageTimeout = null

	/*

	{
		'icon': 'user',
		'text': 'Hey!',
		'type': 0
	}

	Message types:

	0 - Neutral
	1 - Success
	2 - Warning
	3 - Error

	*/

	const messages = []

	function addEventListeners(node)
	{
		// c-click

		node.querySelectorAll('[c-click]').forEach(element => {
			element.addEventListener('click', function(event) {
				const attr = element.getAttribute('c-click')

				parseInstructions(attr, element)

				event.stopPropagation()
			})
		})
	}

	function execute(instruction, element = null)
	{
		if (/^action\([a-z\d]+(,.*)?\)$/.test(instruction))
		{
			const args = instruction.slice(7, -1).split(',')
			const data = new FormData()

			data.set('action', args[0])

			for (let i = 1; i < args.length; i++)
			{
				if (/^form\([A-Za-z\d]{8}\)$/.test(args[i]))
				{
					const form = document.getElementById(args[i].slice(5, -1))

					if (!form) continue

					// Collecting text and password inputs

					const textInputs = form.querySelectorAll('input[type=text],input[type=password]')

					for (let j = 0; j < textInputs.length; j++)
					{
						const name = textInputs[j].getAttribute('name')

						if (name && /^[a-z_\d]+$/.test(name))
							data.set(name, textInputs[j].value)
					}
				}
			}

			post (data)
		}
		else if (instruction === 'hide')
		{
			if (element && typeof element === 'object')
				element.style.display = 'none'
		}
	}

	function message(text, type)
	{
		const message = document.getElementById('message')

		if (!message)
			return

		let icon = 'info-circle'

		if (type === 1)
			icon = 'check-circle'
		else if (type === 2)
			icon === 'exclamation-triangle'
		else if (type === 3)
			icon === 'times-circle'

		clearTimeout(messageTimeout)

		message.innerHTML = '<div><i class="fa fa-'+icon+'"></i></div><div>'+text+'</div>'

		message.style.display = 'grid'

		messageTimeout = setTimeout(() => { message.style.display = 'none' }, 3000)
	}

	function parseInstructions(instructions, element = null)
	{
		let instruction = ''
		let parenthesisCount = 0

		for (let i = 0; i < instructions.length; i++)
		{

			if (instructions[i] === ';' && !parenthesisCount)
			{
				execute(instruction, element)
				instruction = ''
				continue
			}

			if (instructions[i] === '(') parenthesisCount++
			else if (instructions[i] === ')') parenthesisCount--

			instruction += instructions[i]
		}

		if (instruction.length && !parenthesisCount)
			execute(instruction, element)
	}

	async function post(data)
	{
		if (loading) return

		loading = true

		try
		{
			const response = await fetch('index.php', { method: 'POST', body: data })

			if (!response.ok)
				throw new Error('HTTP ' + response.status + ' ' + response.statusText)

			const json = await response.json()

			if (typeof json.go === 'string')
			{
				if (typeof json.message === 'object')
					localStorage.setItem('message', JSON.stringify(json.message))

				window.location.assign(window.location.origin + window.location.pathname + json.go)

				return
			}

			if (typeof json.message === 'object')
				message(json.message.text, json.message.type)
		}
		catch (error) { console.error(error) }

		loading = false
	}

	addEventListeners(document.body)

	try
	{
		const storedMessage = JSON.parse(localStorage.getItem('message'))

		if (storedMessage && typeof storedMessage === 'object')
		{
			message(storedMessage.text, storedMessage.type)

			localStorage.removeItem('message')
		}
	}
	catch (error) { console.error(error) }
})()