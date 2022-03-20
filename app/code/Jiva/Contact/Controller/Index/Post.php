namespace Jiva\Contact\Controller\Index;


public function __construct(
Context $name,
Context $context,
ConfigInterface $contactsConfig,
MailInterface $mail,
DataPersistorInterface $dataPersistor,
LoggerInterface $logger = null
) {
parent::__construct($context, $contactsConfig);
$this->context = $name;
$this->context = $context;
$this->mail = $mail;
$this->dataPersistor = $dataPersistor;
$this->logger = $logger ?: ObjectManager::getInstance()->get(LoggerInterface::class);
}


public function execute()
{
if (!$this->isPostRequest()) {
return $this->resultRedirectFactory->create()->setPath('*/*/');
}
try {
$request = $this->getRequest()->getPostValue();
$model = $this->_objectManager->create('\Jiva\Contact\Model\Contact');
$model->setName($request['name']);
$model->setEmail($request['email']);
$model->setTelephone($request['phone_number']);
$model->setWhereHeard($request['where_heard']);
$model->setMessage($request['what_on_mind']);
$model->save();
$this->sendEmail($this->validatedParams());
$this->messageManager->addSuccessMessage(
__('Thanks for contacting us with your comments and questions. We\'ll respond to you very soon.')
);
$this->dataPersistor->clear('contact_us');

} catch (LocalizedException $e) {
$this->messageManager->addErrorMessage($e->getMessage());
$this->dataPersistor->set('contact_us', $this->getRequest()->getParams());
} catch (\Exception $e) {
$model = $this->_objectManager->create('\Test\Contact\Model\Contact');
print_r($model);
die;
$this->logger->critical($e);
$this->messageManager->addErrorMessage(
__('An error occurred while processing your form. Please try again later.')
);
$this->dataPersistor->set('contact_us', $this->getRequest()->getParams());
}
return $this->resultRedirectFactory->create()->setPath('contact/index');
}


private function sendEmail($post)
{
$this->mail->send(
$post['email'],
['data' => new DataObject($post)]
);
}

private function validatedParams()
{
$request = $this->getRequest();
if (trim($request->getParam('name')) === '') {
throw new LocalizedException(__('Enter the Name and try again.'));
}
if (trim($request->getParam('comment')) === '') {
throw new LocalizedException(__('Enter the comment and try again.'));


}
if (false === \strpos($request->getParam('email'), '@')) {
throw new LocalizedException(__('The email address is invalid. Verify the email address and try again.'));
}
if (trim($request->getParam('hideit')) !== '') {
throw new \Exception();
}

return $request->getParams();
}
}

