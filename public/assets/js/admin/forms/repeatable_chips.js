

$(document).ready(async function () {


  // console.log('event id ' + eventId.val(), 'player Id ' + playerId.val())


  for (let i = 0; i < $('.repeatable-element').length; i++ ) {

  let payout = $("[name='eventChipPlayers["+ i + "][payout]']")
  let position = $("[name='eventChipPlayers["+ i + "][position]']")
  let playerId = $("[name='eventChipPlayers["+ i +"][player_id]']")
  let eventId = $("[name='event_id']")


  $.ajax({
    url: `/api/payout/player/${playerId.val()}/event/${eventId.val()}`,
    method: 'GET'
  }).then(function (a) {
    payout.val(a.prize)
    position.val(a.position)
  })


  }

})



