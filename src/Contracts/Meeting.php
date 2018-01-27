<?php
declare(strict_types = 1);

namespace Abiodunjames\Bigbluebutton\Contracts;

use BigBlueButton\Parameters\CreateMeetingParameters;
use BigBlueButton\Parameters\EndMeetingParameters;
use BigBlueButton\Parameters\GetMeetingInfoParameters;
use BigBlueButton\Parameters\GetRecordingsParameters;
use BigBlueButton\Parameters\JoinMeetingParameters;

interface Meeting
{
    /**
     *  Return a list of all meetings
     *
     * @return mixed
     */
    public function all();

    /**
     * @param \BigBlueButton\Parameters\CreateMeetingParameters $meeting
     * @return bool
     */
    public function create(CreateMeetingParameters $meeting);

    /**
     *  Join meeting
     *
     * @param \BigBlueButton\Parameters\JoinMeetingParameters $meeting
     * @return string
     */
    public function join(JoinMeetingParameters $meeting);

    /**
     *  Returns information about the meeting
     *
     * @param \BigBlueButton\Parameters\GetMeetingInfoParameters $meeting
     * @return bool|\SimpleXMLElement
     */
    public function get(GetMeetingInfoParameters $meeting);

    /**
     *  Close meeting
     *
     * @param \BigBlueButton\Parameters\EndMeetingParameters $meeting
     * @return \BigBlueButton\Responses\EndMeetingResponse
     */
    public function close(EndMeetingParameters $meeting);

    /**
     *
     * @param \BigBlueButton\Parameters\GetRecordingsParameters $recording
     * @return mixed
     */
    public function getRecording(GetRecordingsParameters $recording);
}
