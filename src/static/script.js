(function () {
	"use strict";

	let loading = false

	let messageTimeout = null

	function addEventListeners(node)
	{
		node.querySelectorAll('[c-click]').forEach(element => {
			element.addEventListener('click', function(event) {
				const attr = element.getAttribute('c-click')

				parseInstructions(attr, element)

				event.stopPropagation()
			})
		})

		node.querySelectorAll('[c-change]').forEach(element => {
			element.addEventListener('change', function(event) {
				const attr = element.getAttribute('c-change')

				parseInstructions(attr, element)

				event.stopPropagation()
			})
		})
	}

	function execute(instruction, element)
	{
		if (/^action\([a-z_\d]+(,.*)?\)$/.test(instruction))
		{
			const args = instruction.slice(7, -1).split(',',1000)
			const data = new FormData()

			data.set('action', args[0])

			for (let i = 1; i < args.length; i++)
			{
				if (/^form\([A-Za-z\d]{8}\)$/.test(args[i]))
				{
					const form = document.getElementById(args[i].slice(5, -1))

					if (!form) continue

					let inputs = form.querySelectorAll('input:not([type=checkbox]),select')

					for (let j = 0; j < inputs.length; j++)
					{
						const name = inputs[j].getAttribute('name')

						if (name && /^[a-z_\d]*$/.test(name))
							data.set(name, inputs[j].value)
					}

					inputs = form.querySelectorAll('input[type=checkbox]')

					for (let j = 0; j < inputs.length; j++)
					{
						const name = inputs[j].getAttribute('name')

						if (name && /^[a-z_\d]*$/.test(name))
							data.set(name, inputs[j].checked ? 1 : 0)
					}
				}
				else if (/^[A-Za-z_\d]{1,256}:value\([A-Za-z\d]{8}\)$/.test(args[i]))
				{
					const input = document.getElementById(args[i].slice(-9, -1))

					data.set(args[i].split(':',1)[0], input.value)
				}
				else if (/^[A-Za-z_\d]{1,256}:[A-Za-z_\d]{1,256}$/.test(args[i]))
					data.set(args[i].split(':',1)[0], args[i].split(':',2)[1])
			}

			post(data)
		}
		else if (/^route\([a-z_\d]+\)$/.test(instruction))
			window.location.assign(window.location.origin + '/?route=' + instruction.slice(6, -1))
		else if (instruction === 'hide' && element)
			element.style.display = 'none'
	}

	function message(text, type)
	{
		const message = document.getElementById('message')

		if (!message)
			return

		let icon = 'info-circle'
		let textColor = 'inherit'
		let backgroundColor = '#FFFFFF'

		if (type === 1)
		{
			icon = 'check-circle'
			textColor = 'inherit'
			backgroundColor = '#DDFFDD'
		}
		else if (type === 2)
		{
			icon = 'exclamation-triangle'
			textColor = 'inherit'
			backgroundColor = '#FFFFDD'
		}
		else if (type === 3)
		{
			icon = 'times-circle'
			textColor = '#FFFFFF'
			backgroundColor = '#FF0000'
		}

		clearTimeout(messageTimeout)

		message.innerHTML = '<div><i class="fa fa-'+icon+'"></i></div><div>'+text+'</div>'

		message.style.color = textColor
		message.style.backgroundColor = backgroundColor
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

			if (typeof json.route === 'string' && /^[a-z_\d]{1,256}$/.test(json.route))
			{
				if (typeof json.message === 'object')
					localStorage.setItem('message', JSON.stringify(json.message))

				window.location.assign(window.location.origin + '?route=' + json.route)
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