const mapProperties = {
  id: "Id",
  name: "Name",
  address: "Address",
  phone: "Phone"
}

const capitalize = (s) => s && s.length > 0 && s[0].toUpperCase() + s.slice(1)

const transcribeProperty = (s) => mapProperties[s] ? mapProperties[s] : s

export default {
  capitalize,
  transcribeProperty
}
