import requests
import csv
import time


class FBM():
	def __init__(self, url, token=None):
		self.url = url
		self.token = token
		self.session = requests.Session()

	def auth(self, user, password):
		# headers = {'User-Agent': 'Mozilla/5.0'}
		payload = {
			'username': user,
			'password': password,
			'location': '1',
			'action': 'Login'
		}
		self.session.post('https://' + self.url + '/login/', data=payload)

	def GetDonors(self):
		try:
			return self.donor_table
		except AttributeError:
			payload = {
				'fileName': "",
				'col[donors.donors_79fe2d07e8]': '1',
				'col[donors.firstName]': '1',
				'col[donors.middleName]': '1',
				'col[donors.lastName]': '1',
				'col[donors.donors_e0feeaff84]': '1',
				'col[donors.donors_730b308554]': '1',
				'col[donors.donors_b4d4452788]': '1',
				'col[donors.streetAddress]': '1',
				'col[donors.city]': '1',
				'col[donors.zipCode]': '1',
				'col[donors.updated_at]': "",
				'col[donors.created_at]': "",
				'col[donors.donors_6213775871]': '1',
				'col[donors.donors_b5b26b9572]': "",
				'col[donors.donors_f64c0a6975]': "",
				'col[donors.donorType_id]': "",
				'col[donors.donors_ca3eab528a]': "",
				'col[donations.maxDate1]': "",
				'col[donations.maxDate2]': "",
				'col[donations.donationTypeSum]': '1',
				'conditions[type]': 'And',
				'conditions[1][field]': 'donors.created_at',
				'conditions[1][action]': 'dlte',
				'conditions[1][value]': time.strftime('%Y-%m-%d'),
				'conditions[1][id]': '1',
				'conditions[1][blockType]': 'item',
				'conditions[1][parent]': "",
				'blockCount': '2'
			}
			r = self.session.post('https://' + self.url +
							'/reports/donor/donors/csv/',
							data=payload,
							stream=True)
			r.raw.decode_content = True
			self.donor_table = csv.reader(str(r.raw.data).split('\n'))
		return self.donor_table

	def GetDonations(self):
		try:
			return self.donation_table
		except AttributeError:
			payload = {
				'fileName': '',
				'donation_type': '0',
				'col[donors.id]': '1',
				'col[donors.donors_965f466338]': '',
				'col[donors.donors_79fe2d07e8]': '',
				'col[donors.donors_1f13985a81]': '',
				'col[donors.firstName]': '1',
				'col[donors.middleName]': '1',
				'col[donors.lastName]': '1',
				'col[donors.donors_e0feeaff84]': '1',
				'col[donors.donors_730b308554]': '',
				'col[donors.donors_c42c9d40e7]': '',
				'col[donors.donors_b4d4452788]': '1',
				'col[donors.donors_32bb7cac8a]': '',
				'col[donors.streetAddress]': '',
				'col[donors.apartment]': '',
				'col[donors.city]': '1',
				'col[donors.state]': '1',
				'col[donors.zipCode]': '1',
				'col[donors.updated_at]': '',
				'col[donors.created_at]': '1',
				'col[donors.donors_6213775871]': '1',
				'col[donors.donors_b5b26b9572]': '',
				'col[donors.donors_f64c0a6975]': '',
				'col[donors.donorType_id]': '',
				'col[donors.donors_ca3eab528a]': '',
				'col[donations.donationType_id]': '1',
				'col[donations.donations_1b458b4e6a]': '1',
				'col[donations.updated_at]': '',
				'col[donations.created_at]': '',
				'col[donations.donation_at]': '1',
				'col[donations.donations_be547d16da]': '',
				'col[donations.donations_3f9a0026fb]': '',
				'col[donations.donations_41420c6893]': '1',
				'col[donations.donations_6092e999f4]': '',
				'col[donations.donations_cc3b79a3ac]': '',
				'col[donations.donations_c682fe74bc]': '',
				'col[donations.donations_a7cbfb7452]': '',
				'col[donations.donations_3abbac390f]': '',
				'col[donations.donations_1704817e34]': '',
				'col[donations.donations_0968598e1b]': '',
				'col[donations.donations_14cb406f01]': '',
				'col[donations.donations_6bc08b419a]': '',
				'col[donations.donations_b09ad16128]': '',
				'col[donations.donations_6af401c28c]': '',
				'col[donations.donations_f695e975c6]': '1',
				'col[donations.donations_14a9bdf34a]': '',
				'col[donations.donations_e0a1fae0a3]': '',
				'col[donations.donations_8aa869cbca]': '',
				'col[donations.donations_25a044ed83]': '',
				'col[donations.donations_bda7493c96]': '',
				'col[donations.donations_e0b297f1a2]': '',
				'col[donations.donations_f8fe28e928]': '',
				'col[donations.donations_15c93726c9]': '',
				'col[donations.donations_efb28401ee]': '',
				'col[donations.donations_34ed818c47]': '',
				'col[donations.donations_142c1f8e73]': '',
				'col[donations.donations_5204fdf0a9]': '',
				'col[donations.donations_6058571536]': '',
				'conditions[type]': 'And',
				'conditions[1][field]': 'donations.donation_at',
				'conditions[1][action]': 'dlte',
				'conditions[1][value]': time.strftime('%Y-%m-%d'),
				'conditions[1][id]': '1',
				'conditions[1][blockType]': 'item',
				'conditions[1][parent]': '',
				'blockCount': '2'
			}
			r = self.session.post('https://' + self.url +
							'/reports/donor/donations/csv/',
							data=payload,
							stream=True)
			r.raw.decode_content = True
			self.donation_table = csv.reader(str(r.raw.data).split('\n'))
		return self.donation_table

