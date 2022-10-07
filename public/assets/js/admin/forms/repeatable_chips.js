

$(document).ready(async function () {

  let payout = $("[name='players[0][payout]']")
  let playerId = $("[name='players[0][player_id]']")
  let eventId = $("[name='event_id']")

  // console.log('event id ' + eventId.val(), 'player Id ' + playerId.val())


  for (let i = 0; i < $('.repeatable-element').length; i++ ) {



  let payout = $("[name='players["+ i + "][payout]']")
  let playerId = $("[name='players["+ i +"][player_id]']")
  let eventId = $("[name='event_id']")

  $.ajax({
    url: `/api/payout/${playerId.val()}/${eventId.val()}`,
    method: 'GET'
  }).then(function (a) {
    payout.val(a)
  })


  }

})



