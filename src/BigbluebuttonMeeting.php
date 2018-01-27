<?php
namespace Abiodunjames\Bigbluebutton;

use Abiodunjames\Bigbluebutton\Contracts\Meeting;
use BigBlueButton\BigBlueButton;
use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\EndMeetingParameters;
use BigBlueButton\Parameters\GetMeetingInfoParameters;
use BigBlueButton\Parameters\GetRecordingsParameters;
use BigBlueButton\Parameters\JoinMeetingParameters;

class BigbluebuttonMeeting implements Meeting
{
    /**
     * @var BigBlueButton
     */
    protected $bbb;

    public function __construct(BigBlueButton $bbb)
    {
        $this->bbb =$bbb;
    }

    /**
     *  Return a list of all meetings
     *
     * @return mixed
     */
    public function all()
    {
        $response = $this->bbb->getMeetings();
        if ($response->getReturnCode() == 'SUCCESS') {
            return $response->getRawXml()->meetings->meeting;
        }

        return false;
    }

    /**
     * @param \BigBlueButton\Parameters\CreateMeetingParameters $meeting
     * @return bool
     */
    public function create(CreateMeetingParameters $meeting)
    {
        $response = $this->bbb->createMeeting($meeting);
        if ($response->getReturnCode() == 'FAILED') {
            return false;
        } else {
            return true;
        }
    }

    /**
     *  Join meeting
     *
     * @param \BigBlueButton\Parameters\JoinMeetingParameters $meeting
     * @return string
     */
    public function join(JoinMeetingParameters $meeting)
    {
        return $this->bbb->getJoinMeetingURL($meeting);
    }

    /**
     *  Returns information about the meeting
     *
     * @param \BigBlueButton\Parameters\GetMeetingInfoParameters $meeting
     * @return bool|\SimpleXMLElement
     */
    public function get(GetMeetingInfoParameters $meeting)
    {
        $response = $this->bbb->getMeetingInfo($meeting);
        if ($response->getReturnCode() == 'FAILED') {
            return true;
        } else {
            return $response->getRawXml();
        }
    }

    /**
     *  Close meeting
     *
     * @param \BigBlueButton\Parameters\EndMeetingParameters $meeting
     * @return \BigBlueButton\Responses\EndMeetingResponse
     */
    public function close(EndMeetingParameters $meeting)
    {
        return $this->bbb->endMeeting($meeting);
    }

    /**
     *
     * @param \BigBlueButton\Parameters\GetRecordingsParameters $recording
     * @return mixed
     */
    public function getRecording(GetRecordingsParameters $recording)
    {
        $response = $this->bbb->getRecordings($recording);

        if ($response->getReturnCode() == 'SUCCESS') {
            return $response->getRawXml()->recordings->recording;
        }

        return false;
    }
}
